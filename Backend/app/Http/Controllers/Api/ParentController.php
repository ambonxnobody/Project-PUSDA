<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ParentController extends Controller
{
    // protected $user;
    // public function __construct()
    // {
    //     $this->user = JWTAuth::parseToken()->authenticate();
    // }


    /**
     * @OA\Get(
     *     path="/api/parent",
     *     tags={"Parents"},
     *     operationId="parents",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function getAllParent(Request $request)
    {
        $auhtor = $request->input('auhtor');
        $keyword = $request->input('keyword');

        $parentQuery = Parents::query();

        $parents = $parentQuery;

        if ($auhtor) {
            $parents->whereHas('user', function ($query) use ($auhtor) {
                $query->where('auhtor', $auhtor);
            });
        }

        if ($keyword) {
            $columns = \Schema::getColumnListing((new Parents)->getTable());

            $parent = Parents::where(function ($query) use ($auhtor) {
                $query->where('auhtor', $auhtor);
            })->where(function ($query) use ($columns, $keyword) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', "%{$keyword}%");
                }
            })->orderBy('id', 'DESC')->paginate(10);


            if (count($parent)) {
                return ResponseFormatter::responseSuccessWithData('Data ditemukan', $parent);
            } else {
                return response()->json(['Result' => 'Data tidak ditemukan'], 404);
            }
        }

        return ResponseFormatter::responseSuccessWithData('Berhasil mendapatkan semua data tanah induk', $parents->orderBy('id', 'DESC')->paginate(10));
    }


    public function getAllParentWithUserLogIn(Request $request)
    {
        $keyword = $request->input('keyword');

        $columns = \Schema::getColumnListing((new Parents)->getTable());

        $parent = Parents::where(function ($query) {
            // $query->where('auhtor',  Auth::user()->id); OLD
            $query->where('auhtor',  Auth::user()->roles()->pluck('id'));
        })->where(function ($query) use ($columns, $keyword) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$keyword}%");
            }
        })->orderBy('id', 'DESC')->paginate(10);

        return ResponseFormatter::responseSuccessWithData('Berhasil mendapatkan data tanah induk', $parent);
    }

    public function getById(Request $request, $id)
    {
        $parent_query = Parents::with(['user']);

        $parent = $parent_query->find($id);

        if ($parent) {
            return ResponseFormatter::responseSuccessWithData('Tanah induk ditemukan', $parent);
        }

        return ResponseFormatter::responseError("Tanah induk tidak ditemukan", 400);
    }

    /**
     * @OA\Get(
     *     path="/api/parent/search/{keyword}",
     *     tags={"Parents"},
     *     operationId="parentsSearch",
     *     @OA\Parameter(
     *          name="other",
     *          description="other",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    // public function search($keyword)
    // {
    //     $result = Parents::with(['user'])
    //         ->where('auhtor', '=', Auth::user()->id)
    //         ->orwhere('certificate_number', 'LIKE', '%' . $keyword . '%')
    //         ->orWhere('certificate_date', 'LIKE', '%' . $keyword . '%')
    //         ->orWhere('address', 'LIKE', '%' . $keyword . '%')
    //         ->orWhere('large', 'LIKE', '%' . $keyword . '%')
    //         ->orWhere('asset_value', 'LIKE', '%' . $keyword . '%')
    //         ->get();
    //     if (count($result)) {
    //         return ResponseFormatter::responseSuccessWithData('Data ditemukan', $result);
    //     } else {
    //         return response()->json(['Result' => 'Data tidak ditemukan'], 404);
    //     }
    // }




    /**
     * @OA\Post(
     *     path="/api/parent/create",
     *     tags={"Parents"},
     *     operationId="parentadd",
     *     @OA\Parameter(
     *          name="auhtor",
     *          description="user_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="certificate_number ",
     *          description="certificate_number ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="certificate_date",
     *          description="certificate_date",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="date"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="utilization_type",
     *          description="utilization_type",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="address",
     *          description="address",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="large",
     *          description="large",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="asset_value",
     *          description="large",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function createParent(Request $request)
    {
        $validation = Validator::make($request->only('certificate_number', 'certificate_date', 'item_name', 'address', 'large', 'asset_value'), [
            'certificate_number' => 'required|integer',
            'certificate_date' => 'required',
            'item_name' => 'required',
            'address' => 'required',
            'large' => 'required',
            'asset_value' => 'required'
        ]);

        if ($validation->fails()) :
            return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            $file_application = $request->auhtor;

            $parent = Parents::create([
                'auhtor' => isset($file_application) ? $file_application :  Auth::user()->id,
                'certificate_number' => $request->certificate_number,
                'certificate_date' => $request->certificate_date,
                'item_name' => $request->item_name,
                'address' => $request->address,
                'large' => $request->large,
                'asset_value' => $request->asset_value,
            ]);

            $data = Parents::where('id', $parent->id)->with(['user'])->get();

            if ($data) :
                return ResponseFormatter::responseCreated('Berhasil membuat tanah induk', $data);
            else :
                return ResponseFormatter::responseError('Tanah induk gagal dibuat', 400);
            endif;
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/parent/update/{id}",
     *     tags={"Parents"},
     *     operationId="parentupdate",
     *     @OA\Parameter(
     *          name="certificate_number ",
     *          description="certificate_number ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="certificate_date",
     *          description="certificate_date",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="date"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="utilization_type",
     *          description="utilization_type",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="address",
     *          description="address",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="large",
     *          description="large",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="asset_value",
     *          description="large",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function updateParent(Request $request, $id)
    {
        $validation = Validator::make($request->only('certificate_number', 'certificate_date', 'item_name', 'address', 'large', 'asset_value'), [
            'certificate_number' => 'required|integer',
            'certificate_date' => 'required',
            'item_name' => 'required',
            'address' => 'required',
            'large' => 'required',
            'asset_value' => 'required'
        ]);

        if ($validation->fails()) :
            return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            $parent = Parents::find($id);

            if (!$parent) {
                throw new Exception('Tanah induk tidak ditemukan');
            }

            $parent->update([
                'certificate_number' => $request->certificate_number,
                'certificate_date' => $request->certificate_date,
                'item_name' => $request->item_name,
                'address' => $request->address,
                'large' => $request->large,
                'asset_value' => $request->asset_value,
            ]);
            $parent->save();

            if ($parent) :
                return ResponseFormatter::responseSuccessWithData('Sukses update tanah induk', $parent);
            else :
                return ResponseFormatter::responseError('Tanah induk gagal di update', 400);
            endif;
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/parent/delete/{id}",
     *     tags={"Parents"},
     *     operationId="parentdelete",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function deleteParent($id)
    {
        try {
            $parent = Parents::find($id);

            if (!$parent) {
                throw new Exception('Tanah induk tidak ditemukan');
            }

            $parent->delete();

            return ResponseFormatter::responseSuccess('Sukses hapus tanah induk');
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }
}
