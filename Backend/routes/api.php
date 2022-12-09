<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ParentController;
use App\Http\Controllers\Api\ChilderController;
use App\Http\Controllers\Api\ImportExportData;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ForgotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// authentication
Route::post('login', [AuthenticationController::class, 'login']);


// Reset Password
Route::post('password/reset', [ForgotController::class, 'reset']);
Route::post('password/email', [ForgotController::class, 'forgot']);



Route::group(['middleware' => ['jwt.verify']], function () {

    Route::get('/admin/role', [AuthenticationController::class, 'getRole']);

    // Add user access
    Route::post('/admin/add/user', [AuthenticationController::class, 'addUser']);
    Route::get('/admin/edit/user/{id}', [AuthenticationController::class, 'editUser']);
    Route::put('/admin/update/user/{id}', [AuthenticationController::class, 'updateUser']);
    Route::delete('/admin/delete/user/{id}', [AuthenticationController::class, 'deleteUser']);

    // Get User
    Route::get('user', [AuthenticationController::class, 'getUser']);
    Route::post('/user/upload/photo/{id}', [ProfileController::class, 'upload']);
    Route::put('/user/update/{id}', [ProfileController::class, 'update']);
    Route::post('/user/change-password', [ProfileController::class, 'changePassword']);

    // logout
    Route::get('logout', [AuthenticationController::class, 'logout']);

    // Get User All for admin
    Route::get('/user/all', [ProfileController::class, 'userAll']);

    //  Export All Data
    // Route::get('/export/all/data/upt', [ImportExportData::class, 'exportMapping']);
    Route::get('/export/all/data/upt', [DashboardController::class, 'getDataUPTAllExport']);
    //  Export UPT Data
    // Route::get('/export/data', [ImportExportData::class, 'exportMappingUpt']);
    Route::get('/export/data', [DashboardController::class, 'getDataUPTExport']);
    //  Import File parent
    Route::post('/import/file/parent', [ImportExportData::class, 'import_parent']);
    //  Import File parent
    Route::post('/import/file/children/{id}', [ImportExportData::class, 'import_children']);

    // parent
    Route::group(['prefix' => 'parent'], function () {
        Route::post('/create', [ParentController::class, 'createParent']);
        Route::get('/', [ParentController::class, 'getAllParentWithUserLogIn']);
        Route::get('/all', [ParentController::class, 'getAllParent']);
        Route::get('/{id}', [ParentController::class, 'getById']);
        Route::post('/update/{id}', [ParentController::class, 'updateParent']);
        Route::delete('/delete/{id}', [ParentController::class, 'deleteParent']);
    });

    // childer
    Route::group(['prefix' => 'childer'], function () {
        Route::post('/create', [ChilderController::class, 'createChilder']);
        // Route::post('/createPayment', [ChilderController::class, 'createChilderPayment']);
        Route::get('/', [ChilderController::class, 'getAllByParentUser']);
        Route::get('/all', [ChilderController::class, 'getAllChilder']);
        Route::get('/{id}', [ChilderController::class, 'getById']);
        Route::post('/update/{id}', [ChilderController::class, 'updateChilder']);
        // Route::post('/updatePayment/{id}', [ChilderController::class, 'updateChilderPayment']);
        Route::delete('/delete/{id}', [ChilderController::class, 'deleteChilder']);
    });

    // payment
    Route::group(['prefix' => 'payment'], function () {
        Route::post('/create', [PaymentController::class, 'createPayment']);
        Route::get('/', [PaymentController::class, 'getAll']);
        Route::get('/all', [PaymentController::class, 'getAllPayment']);
        // Route::get('/All', [PaymentController::class, 'get']);
        // Route::get('/all/{id}', [PaymentController::class, 'getAllPaymentByChilder']);
        Route::get('/{id}', [PaymentController::class, 'getById']);
        Route::post('/update/{id}', [PaymentController::class, 'updatePayment']);
        Route::delete('/delete/{id}', [PaymentController::class, 'deletePayment']);
    });

    // dashboard
    Route::get('/dashboard/all/{year}', [DashboardController::class, 'getAll']);
    Route::get('/dashboard/{year}', [DashboardController::class, 'get']);
});
