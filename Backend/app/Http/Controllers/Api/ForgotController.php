<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotController extends Controller
{

     /**
     * @OA\Post(
     *     path="/api/password/email",
     *     tags={"Authentication"},
     *     operationId="passdEmail",
     *     @OA\Parameter(
     *          name="email",
     *          description="Email",
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

    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);
        return response()->json(["message" => "Token Berhasil didapatkan,Silakan mengatur ulang kata sandi anda!"]);
    }



    /**
     * @OA\Post(
     *     path="/api/password/reset",
     *     tags={"Authentication"},
     *     operationId="resetPassword",
     *     @OA\Parameter(
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="password",
     *          description="Password",
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
    public function reset(ResetPasswordRequest $request)
    {
        $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
            $user->password =  Hash::make($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["message" => "Token yang diberikan tidak valid"], 400);
        }
        return response()->json(["message" => "Kata sandi telah berhasil diubah"]);


    }

}
