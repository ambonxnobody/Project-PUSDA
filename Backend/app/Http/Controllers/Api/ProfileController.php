<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;

class ProfileController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/user/upload/photo/{id}",
     *     tags={"Profile"},
     *     summary="User uploaded photo after log in",
     *     operationId="upload",
     *     @OA\Parameter(
     *          name="photo",
     *          description="photo",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *  @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function upload($id,Request $request)
    {
        $this->validate($request,
        [
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $user = User::find($id);
            $imageName = time().'.'.$request->photo->extension();

            $path = public_path('photos');

            if(!empty($user->photo) && file_exists($path.'/'.$user->photo)) :
                unlink($path.'/'.$user->photo);
            endif;

            $user->photo = $imageName;
            $user->save();

            $request->photo->move(public_path('photos'), $imageName);

            return ResponseFormatter::responseSuccessWithData('Photo Berhasil Diunggah!', $user);

        } catch(Exception $e){
            return ResponseFormatter::responseError($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/user/update/{id}",
     *     tags={"Profile"},
     *     summary="User changes data after login",
     *     operationId="userupdate",
     *     @OA\Parameter(
     *          name="email",
     *          description="email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="name",
     *          description="name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *  @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:240',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

       try {
        $user = User::find($id);
        $user->name = $request->name;
        $user->slug = Str::slug($request->get('name'));
        $user->email  = $request->email;
        $user->update();
        $user->attachRole($request->role_id);

        return ResponseFormatter::responseSuccessWithData('Akun telah berhasil diperbarui!', $user);

        } catch(Exception $e){
            return ResponseFormatter::responseError($e->getMessage(), 400);
        }
    }


    /**
     * @OA\Post(
     *     path="/api/user/change-password",
     *     tags={"Profile"},
     *     summary="The user changes the password after logging in",
     *     operationId="userupdatepass",
     *     description="Password minimum 8 character",
     *
     *     @OA\Parameter(
     *          name="current_passsowrd",
     *          description="current_passsowrd",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="password",
     *          description="password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="password_confirmation",
     *          description="password_confirmation",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->only('current_passsowrd','password'), [
            'current_passsowrd' => 'required',
            'password' => 'required|min:8|confirmed|different:current_passsowrd',
       ]);

        if(Hash::check($request->current_passsowrd,Auth::user()->password))
        {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            return ResponseFormatter::responseCreated('Kata sandi telah berhasil diubah, Silakan Keluar dan uji kata sandi baru Anda!');
        }
        else {
        return response()->json([
                'status' => false,
                'message' => 'Kata sandi tidak cocok'
        ],400);
        }
    }


     /**
     * @OA\Get(
     *     path="/api/user/all",
     *     tags={"Admin"},
     *     operationId="Admin",
     *     summary="Admin all access user",
     *     description="only my admin role can access this api",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function userAll(){

        $user = User::with('roles')->paginate(10);
        return response()->json($user, 200);

    }
}
