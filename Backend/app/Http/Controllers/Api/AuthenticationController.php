<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Models\Role;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{

        /**
        * @OA\Post(
        * path="/api/login",
        * operationId="authLogin",
        * tags={"Authentication"},
        * summary="User Login",
        * description="Login User Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"email", "password"},
        *               @OA\Property(property="email", type="email"),
        *               @OA\Property(property="password", type="password")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Selamat datang! Anda berhasil masuk",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Selamat datang! Anda berhasil masuk",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=400,
        *          description="Kredensial masuk tidak valid,Bad request",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=500,
        *          description="Tidak dapat membuat token",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:50'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::responseValidation($validator->errors());
        }

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Kredensial masuk tidak valid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Tidak dapat membuat token.',
                ], 404);
        }
        $user = Auth::user();
        return response()->json([
            'status' => true,
            'message' => 'Selamat datang! Anda berhasil masuk',
            'token' => $token,
            'user' => array_merge($user->toArray(),
            ['roles' => $user->roles()->get()->toArray()]),

        ]);

    }

     /**
     * @OA\Get(
     *     path="/api/user",
     *     tags={"Authentication"},
     *     summary="Get Data User after Login",
     *     operationId="User",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function getUser(Request $request)
    {
        $user = auth()->user();
        $data = array_merge($user->toArray(),
        [
            'roles' => $user->roles()->get()->toArray(),
        ]);
        return response()->json($data,200);
    }

     /**
     * @OA\Get(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     summary="User Log Out",
     *     operationId="logout",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        // Auth::logout();
        // return ResponseHelper::responseSuccess('Log out successfully!');

        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        // kirim Gagal response jika request tidak valid
        if ($validator->fails()) {
            return ResponseFormatter::responseValidation($validator->errors());
        }

		// Request divalidasi, lakukan logout
        try {
            JWTAuth::invalidate($request->token);
            return ResponseFormatter::responseSuccess('Logout berhasil!');
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, pengguna tidak dapat logout'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
    * @OA\Post(
    * path="/api/admin/add/user",
    * operationId="addUser",
    * tags={"Admin"},
    * summary="Admin Add access user",
    * description="only admin can add user data",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name","slug","email", "password", "password_confirmation","role_id"},
    *               @OA\Property(property="name", type="text"),
    *               @OA\Property(property="slug", type="text"),
    *               @OA\Property(property="email", type="text"),
    *               @OA\Property(property="password", type="password"),
    *               @OA\Property(property="password_confirmation", type="password"),
    *               @OA\Property(property="role_id", type="integer"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="'Data pengguna ditambahkan diubah!",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="'Data pengguna berhasil ditambahkan!",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function addUser(Request $request)
    {
        $validation = Validator::make($request->only(
            'name',
            'email',
            'password',
            'password_confirmation',
            'slug',
            'role_id',
            ),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
       ]);

       if ($validation->fails()) :
              return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->slug = Str::slug($request->get('name'));
            $user->save();
            $user->attachRole($request->role_id);
            return ResponseFormatter::responseCreated('Data pengguna berhasil ditambahkan!', $user);

        } catch(Exception $e){
            return ResponseFormatter::responseError($e->getMessage(), 400);
        }
    }

    /**
    * @OA\Post(
    * path="/api/admin/update/user/{id}",
    * operationId="editUser",
    * tags={"Admin"},
    * summary="Admin Edit access user",
    * description="only admin can update user data",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name","email","slug","role_id"},
    *               @OA\Property(property="name", type="text"),
    *               @OA\Property(property="slug", type="text"),
    *               @OA\Property(property="email", type="text"),
    *               @OA\Property(property="role_id", type="integer"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="'Data pengguna berhasil diubah!",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="'Data pengguna berhasil diubah!",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */

    public function updateUser(Request $request,$id)
    {
        $validation = Validator::make($request->only(
            'name',
            'email',
            'password',
            'password_confirmation',
            'slug',
            'role_id',
            ),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,'.$id,
       ]);

       if ($validation->fails()) :
              return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->slug = Str::slug($request->get('name'));
            $user->email  = $request->email;
            $user->update();
            $user->syncRoles(explode(',',$request->role_id));
            return ResponseFormatter::responseCreated('Data pengguna berhasil diubah!', $user);

        } catch(Exception $e){
            return ResponseFormatter::responseError($e->getMessage(), 400);
        }
    }



    /**
     * @OA\Get(
     *     path="/api/admin/edit/user/{id}",
     *     tags={"Admin"},
     *     operationId="Adminedituser",
     *     summary="Admin calls user based on his id ",
     *     description="only my admin role can access this api",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function editUser($id){

        $user = User::with('roles')
        ->where('id',$id)->first();
        return response()->json($user, 200);

    }

    /**
     * @OA\Delete(
     *     path="/api/admin/delete/user/{id}",
     *     tags={"Admin"},
     *     operationId="Admindeleteuser",
     *     summary="Admin remove user access ",
     *     description="only my admin role can access this api",
     *     @OA\Response(
     *         response="200",
     *         description="Data pengguna berhasil dihapus"
     *     )
     * )
     */
    public function deleteUser($id){
        try{
            $user = User::find($id);
            $user->delete();
            return ResponseFormatter::responseSuccess('Data pengguna berhasil dihapus!', $user);
        }catch (Exception $e) {
            return ResponseFormatter::responseError($e->getMessage(), 400);
        }
    }

    public function getRole(Request $request){

        $user = Role::all();
        return response()->json($user, 200);

    }


}
