<?php

use App\Http\Controllers\childersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Upt\UptKediriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false,
    'home' => false,
    // 'password.confirm' => false,
    // 'password.email' => false,
    // 'password.request' => false,
    // 'password.reset' => false,
    // 'password.update' => false
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'auth']], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('changes-password', [DashboardController::class, 'changePassword'])->name('change.password');
    Route::post('changes-password', [DashboardController::class, 'changePasswordPost'])->name('changepassword.post');

    Route::post('/import/parent/post', [DashboardController::class, 'import_induk'])->name('importinduk.post');
    Route::post('/import/children/post/{id}', [DashboardController::class, 'import_anak'])->name('importanak.post');

    Route::get('/export/post', [DashboardController::class, 'exportMapping'])->name('export.post');
    Route::get('/download/file', [DashboardController::class, 'exportMappingUpt'])->name('export.postupt');

    Route::get('/upload-photo/{id}', [DashboardController::class, 'vieUpload'])->name('upload.photo');
    Route::post('/upload-photo/{id}', [DashboardController::class, 'vieUploadPost'])->name('uploadphoto.post');

    Route::resource('/profil', ProfileController::class)->except('show', 'create', 'store', 'destroy');

    Route::resource('/assets/soil', ParentsController::class);

    //Childern
    Route::get('/assets/soil/childern/create/{id}', [childersController::class, 'create'])->name('childern.create');
    Route::post('/assets/soil/childern/post', [childersController::class, 'store'])->name('childern.store');
    Route::get('/assets/soil/childern/detail/{id}', [childersController::class, 'show'])->name('childern.show');
    Route::get('/assets/soil/childern/edit/{id}', [childersController::class, 'edit'])->name('childern.edit');
    Route::put('/assets/soil/childern/update/{id}', [childersController::class, 'update'])->name('childern.update');
    Route::delete('/assets/soil/childern/delete/{id}', [childersController::class, 'destroy'])->name('childern.destroy');

    // Payment
    // Route::get('/assets/soil/childern/payment/create/{id}', [PaymentController::class, 'create'])->name('payment.create');
    // Route::post('/assets/soil/childern/payment/post', [PaymentController::class, 'store'])->name('payment.store');

    // CRUD data upt kediri
    Route::resource('/assets-soil/kediri', UptKediriController::class);

    Route::get('/management/users', [DashboardController::class, 'management_index'])->name('usermanagement.index');
    Route::get('/management/user/create', [DashboardController::class, 'management_create'])->name('usermanagement.create');
    Route::post('/management/user/store', [DashboardController::class, 'management_store'])->name('usermanagement.store');
    Route::get('/management/user/edit/{id}', [DashboardController::class, 'management_edit'])->name('usermanagement.edit');
    Route::put('/management/user/update/{id}', [DashboardController::class, 'management_update'])->name('usermanagement.update');
    Route::delete('/management/user/delete/{id}', [DashboardController::class, 'management_destroy'])->name('usermanagement.delete');
});
