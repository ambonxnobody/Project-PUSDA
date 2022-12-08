<?php

namespace App\Http\Controllers\Api;

use App\Exports\DataAllUptExport;
use App\Exports\ExportPerUpt;
use App\Http\Controllers\Controller;
use App\Imports\ParentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\ResponseFormatter;
use App\Imports\AnakImport;
use App\Imports\ChildernImport;
use App\Imports\IndukImport;
use App\Imports\MultiSheetSelector;
use Exception;
use Illuminate\Support\Facades\Validator;

class ImportExportData extends Controller
{

    /**
     * @OA\Post(
     *     path="/import/file/parent",
     *     tags={"Import"},
     *     operationId="importfileparent",
     *     @OA\Parameter(
     *          name="file",
     *          description="file",
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

    public function import_parent(Request $request)
    {
        $validation = Validator::make($request->only('file'), [
            'file' => 'required|mimes:csv,xlx,xls,xlsx'
        ]);

        if ($validation->fails()) :
            return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            Excel::import(new IndukImport, request()->file('file'));
            return ResponseFormatter::responseSuccessWithData('Data Berhasil di Import');
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/import/file/children/{id}",
     *     tags={"Import"},
     *     operationId="importfilechildren",
     *     @OA\Parameter(
     *          name="file",
     *          description="file",
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

    public function import_children(Request $request, $id)
    {
        $validation = Validator::make($request->only('file'), [
            'file' => 'required|mimes:csv,xlx,xls,xlsx'
        ]);

        if ($validation->fails()) :
            return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            Excel::import(new AnakImport($id), request()->file('file'));
            return ResponseFormatter::responseSuccessWithData('Data Berhasil di Import');
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }



    /**
     * @OA\Get(
     *     path="/export/all/data/upt",
     *     tags={"Export"},
     *     operationId="Exportdataall",
     *     summary="Admin access api ",
     *     description="only admin can download all upt data and access api",
     *     @OA\Response(
     *         response="200",
     *         description="Data semua upt berhasil di download!"
     *     )
     * )
     */
    public function exportMapping()
    {
        try {
            Excel::download(new DataAllUptExport(), 'Semua-data-upt.xlsx');
            return ResponseFormatter::responseSuccessWithData('Data semua upt berhasil di unduh!');
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Get(
     *     path="/export/data",
     *     tags={"Export"},
     *     operationId="ExportPerUpt",
     *     summary="users can download data based on their roles ",
     *     description="only user can download all upt data and access api",
     *     @OA\Response(
     *         response="200",
     *         description="Data semua upt berhasil di unduh!"
     *     )
     * )
     */
    public function exportMappingUpt()
    {
        try {
            Excel::download(new ExportPerUpt(), 'file-download.xlsx');
            return ResponseFormatter::responseSuccessWithData('Data berhasil di unduh!');
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }
}
