<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Childer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ChilderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/childer",
     *     tags={"Childers"},
     *     operationId="childers",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function getAllByParentUser(Request $request)
    {
        $keyword = $request->input('keyword');
        $parent_id = $request->input('parent_id');

        if ($keyword && $parent_id) {
            $columns = \Schema::getColumnListing((new Childer)->getTable());

            $childer = Childer::where(function ($query) use ($parent_id) {
                $query->where('parent_id', $parent_id);
            })->where(function ($query) use ($columns, $keyword) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', "%{$keyword}%");
                }
            })->orderBy('id', 'DESC')->paginate(10);


            if (count($childer)) {
                return ResponseFormatter::responseSuccessWithData('Data ditemukan', $childer);
            } else {
                return ResponseFormatter::responseError('Data tidak ditemukan', 400);;
            }
        }
    }


    public function getAllChilder(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $child_query = Childer::with(['parent']);
        $keyword = $request->input('keyword');

        $childs = $child_query;

        if ($parent_id) {
            $childs->whereHas('parent', function ($query) use ($parent_id) {
                $query->where('parent_id', $parent_id);
            });
        }

        if ($keyword && $parent_id) {
            $columns = \Schema::getColumnListing((new Childer)->getTable());

            $childer = Childer::where(function ($query) use ($parent_id) {
                $query->where('parent_id', $parent_id);
            })->where(function ($query) use ($columns, $keyword) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', "%{$keyword}%");
                }
            })->orderBy('id', 'DESC')->paginate(10);


            if (count($childer)) {
                return ResponseFormatter::responseSuccessWithData('Data ditemukan', $childer);
            } else {
                return ResponseFormatter::responseError('Data tidak ditemukan', 400);;
            }
        }

        return ResponseFormatter::responseSuccessWithData('Sukses mendapatkan data tanah bagian', $childs->orderBy('id', 'DESC')->paginate(10));
    }


    public function getById(Request $request, $id)
    {
        $child_query = Childer::with(['Parent']);

        $child = $child_query->find($id);

        if ($child) {
            return ResponseFormatter::responseSuccessWithData('Tanah bagian ditemukan', $child);
        }

        return ResponseFormatter::responseError("Tanah bagian tidak ditemukan", 400);
    }


    /**
     * @OA\Get(
     *     path="/api/childer/search/{keyword}",
     *     tags={"Childers"},
     *     operationId="childersSearch",
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
    // public function search($other)
    // {
    //     $result = Childer::where('rental_retribution', 'LIKE', '%' . $other . '%')
    //         ->orWhere('utilization_engagement_type', 'LIKE', '%' . $other . '%')
    //         ->orWhere('utilization_engagement_name', 'LIKE', '%' . $other . '%')
    //         ->orWhere('allotment_of_use', 'LIKE', '%' . $other . '%')
    //         ->orWhere('coordinate', 'LIKE', '%' . $other . '%')
    //         ->orWhere('large', 'LIKE', '%' . $other . '%')
    //         ->orWhere('validity_period_of', 'LIKE', '%' . $other . '%')
    //         ->orWhere('validity_period_until', 'LIKE', '%' . $other . '%')
    //         ->orWhere('engagement_number', 'LIKE', '%' . $other . '%')
    //         ->orWhere('engagement_date', 'LIKE', '%' . $other . '%')
    //         ->get();
    //     if (count($result)) {
    //         return ResponseFormatter::responseSuccessWithData('Data ditemukan', $result);
    //     } else {
    //         return ResponseFormatter::responseError('Data tidak ditemukan', 400);;
    //     }
    // }




    /**
     * @OA\Post(
     *     path="/api/childer/create",
     *     tags={"Childers"},
     *     operationId="childeradd",
     *     @OA\Parameter(
     *          name="parent_id",
     *          description="parent_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="rental_retribution ",
     *          description="rental_retribution ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="utilization_engagement_type",
     *          description="utilization_engagement_type",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="date"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="utilization_engagement_name",
     *          description="utilization_engagement_name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="allotment_of_use",
     *          description="allotment_of_use",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="coordinate",
     *          description="coordinate",
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
     *          name="validity_period_of",
     *          description="validity_period_of",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="validity_period_until",
     *          description="validity_period_until",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="engagement_number",
     *          description="engagement_number",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="engagement_date",
     *          description="engagement_date",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="application_letter",
     *          description="application_letter",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="agreement_letter",
     *          description="agreement_letter",
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
    public function createChilder(Request $request)
    {
        $validation = Validator::make($request->only('parent_id', 'rental_retribution', 'utilization_engagement_type', 'utilization_engagement_name', 'allotment_of_use', 'coordinate', 'large', 'present_condition', 'validity_period_of', 'validity_period_until', 'engagement_number',  'engagement_date', 'description', 'application_letter', 'agreement_letter'), [
            'parent_id' => 'required',
            'allotment_of_use' => 'required',
            'large' => 'required|integer',
            'application_letter' => 'mimes:doc,docx,pdf,txt,jpg,jpeg,bmp,png',
            'agreement_letter' => 'mimes:doc,docx,pdf,txt,jpg,jpeg,bmp,png',
        ]);

        if ($validation->fails()) :
            return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            if ($request->hasFile('application_letter')) {
                $file_application = $request->file('application_letter')->store('public/documents/applicationletter');
            }
            if ($request->hasFile('agreement_letter')) {
                $file_agreement = $request->file('agreement_letter')->store('public/documents/agreementletter');
            }

            $childer = Childer::create([
                'parent_id' => $request->parent_id,
                'rental_retribution' => $request->rental_retribution,
                'utilization_engagement_type' => $request->utilization_engagement_type,
                'utilization_engagement_name' => $request->utilization_engagement_name,
                'allotment_of_use' => $request->allotment_of_use,
                'coordinate' => $request->coordinate,
                'large' => $request->large,
                'present_condition' => $request->present_condition,
                'validity_period_of' => $request->validity_period_of,
                'validity_period_until' => $request->validity_period_until,
                'engagement_number' => $request->engagement_number,
                'engagement_date' => $request->engagement_date,
                'description' => $request->description,
                'application_letter' => isset($file_application) ? $file_application : '',
                'agreement_letter' => isset($file_agreement) ? $file_agreement : '',
            ]);

            $data = Childer::where('id', $childer->id)->with(['parent'])->get();

            if ($data) :
                return ResponseFormatter::responseCreated('Berhasil membuat tanah bagian', $data);
            else :
                return ResponseFormatter::responseError('Tanah bagian tidak berhasil dibuat', 400);
            endif;
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    public function createChilderPayment(Request $request)
    {
        $validation = Validator::make($request->only('parent_id', 'rental_retribution', 'utilization_engagement_type', 'utilization_engagement_name', 'allotment_of_use', 'coordinate', 'large', 'validity_period_of', 'validity_period_until', 'engagement_number',  'engagement_date', 'description', 'application_letter', 'agreement_letter', 'year', 'payment_amount', 'proof_of_payment'), [
            'parent_id' => 'required',
            'rental_retribution' => 'required',
            'utilization_engagement_name' => 'required',
            'allotment_of_use' => 'required',
            'coordinate' => 'required',
            'large' => 'required|integer',
            'validity_period_of' => 'required',
            'validity_period_until' => 'required',
            'description' => 'required',
            'engagement_number' => 'required',
            'engagement_date' => 'required',
            'application_letter' => 'required|mimes:doc,docx,pdf,txt',
            'agreement_letter' => 'required|mimes:doc,docx,pdf,txt',
            'year' => 'required',
            'payment_amount' => 'required',
            'proof_of_payment' => 'required'
        ]);

        if ($validation->fails()) :
            return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            if ($request->hasFile('application_letter')) {
                $file_application = $request->file('application_letter')->store('public/documents/applicationletter');
            }
            if ($request->hasFile('agreement_letter')) {
                $file_agreement = $request->file('agreement_letter')->store('public/documents/agreementletter');
            }

            $childer = Childer::create([
                'parent_id' => $request->parent_id,
                'rental_retribution' => $request->rental_retribution,
                'utilization_engagement_type' => $request->utilization_engagement_type,
                'utilization_engagement_name' => $request->utilization_engagement_name,
                'allotment_of_use' => $request->allotment_of_use,
                'coordinate' => $request->coordinate,
                'large' => $request->large,
                'validity_period_of' => $request->validity_period_of,
                'validity_period_until' => $request->validity_period_until,
                'engagement_number' => $request->engagement_number,
                'engagement_date' => $request->engagement_date,
                'description' => $request->description,
                'application_letter' => $file_application,
                'agreement_letter' => $file_agreement,
                'year' => $request->year,
                'payment_amount' => $request->payment_amount,
                'proof_of_payment' => $request->proof_of_payment
            ]);

            $data = Childer::where('id', $childer->id)->with(['parent'])->get();

            if ($data) :
                return ResponseFormatter::responseCreated('Berhasil membuat tanah bagian', $data);
            else :
                return ResponseFormatter::responseError('Tanah bagian tidak berhasil dibuat', 400);
            endif;
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }


    /**
     * @OA\Put(
     *     path="/api/childer/update/{id}",
     *     tags={"Childers"},
     *     operationId="childerupdate",
     *     @OA\Parameter(
     *          name="parent_id",
     *          description="parent_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="rental_retribution ",
     *          description="rental_retribution ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="utilization_engagement_type",
     *          description="utilization_engagement_type",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="date"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="utilization_engagement_name",
     *          description="utilization_engagement_name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="allotment_of_use",
     *          description="allotment_of_use",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="coordinate",
     *          description="coordinate",
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
     *          name="validity_period_of",
     *          description="validity_period_of",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="validity_period_until",
     *          description="validity_period_until",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="engagement_number",
     *          description="engagement_number",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="engagement_date",
     *          description="engagement_date",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="application_letter",
     *          description="application_letter",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="agreement_letter",
     *          description="agreement_letter",
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
    public function updateChilder(Request $request, $id)
    {
        // $validation = Validator::make($request->only('parent_id', 'rental_retribution', 'utilization_engagement_type', 'utilization_engagement_name', 'allotment_of_use', 'coordinate', 'large', 'validity_period_of', 'validity_period_until', 'engagement_number',  'engagement_date', 'description', 'application_letter', 'agreement_letter'), [
        //     'application_letter' => 'mimes:doc,docx,pdf,txt',
        //     'agreement_letter' => 'mimes:doc,docx,pdf,txt',
        // ]);

        // if ($validation->fails()) :
        //     return ResponseFormatter::responseValidation($validation->errors());
        // endif;

        try {
            if ($request->hasFile('application_letter')) {
                $file_application = $request->file('application_letter')->store('public/documents');
            }
            if ($request->hasFile('agreement_letter')) {
                $file_agreement = $request->file('agreement_letter')->store('public/documents');
            }


            $childer = Childer::find($id);

            if (!$childer) {
                throw new Exception('Tanah bagian tidak ditemukan');
            }

            $childer->update([
                'parent_id' => $request->parent_id,
                'rental_retribution' => $request->rental_retribution,
                'utilization_engagement_type' => $request->utilization_engagement_type,
                'utilization_engagement_name' => $request->utilization_engagement_name,
                'allotment_of_use' => $request->allotment_of_use,
                'coordinate' => $request->coordinate,
                'large' => $request->large,
                'present_condition' => $request->present_condition,
                'validity_period_of' => $request->validity_period_of,
                'validity_period_until' => $request->validity_period_until,
                'engagement_number' => $request->engagement_number,
                'engagement_date' => $request->engagement_date,
                'description' => $request->description,
                'application_letter' => isset($file_application) ? $file_application : '',
                'agreement_letter' => isset($file_agreement) ? $file_agreement : '',
            ]);
            $childer->save();

            if ($childer) :
                return ResponseFormatter::responseSuccessWithData('Berhasil update tanah bagian', $childer);
            else :
                return ResponseFormatter::responseError('Tanah bagian gagal di update', 400);
            endif;
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    public function updateChilderPayment(Request $request, $id)
    {
        $validation = Validator::make($request->only('parent_id', 'rental_retribution', 'utilization_engagement_type', 'utilization_engagement_name', 'allotment_of_use', 'coordinate', 'large', 'validity_period_of', 'validity_period_until', 'engagement_number',  'engagement_date', 'description', 'application_letter', 'agreement_letter', 'year', 'payment_amount', 'proof_of_payment'), [
            'parent_id' => 'required',
            'rental_retribution' => 'required',
            'utilization_engagement_name' => 'required',
            'allotment_of_use' => 'required',
            'coordinate' => 'required',
            'large' => 'required|integer',
            'validity_period_of' => 'required',
            'validity_period_until' => 'required',
            'description' => 'required',
            'engagement_number' => 'required',
            'engagement_date' => 'required',
            'application_letter' => 'required|mimes:doc,docx,pdf,txt',
            'agreement_letter' => 'required|mimes:doc,docx,pdf,txt',
            'year' => 'required',
            'payment_amount' => 'required',
            'proof_of_payment' => 'required'
        ]);

        if ($validation->fails()) :
            return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {
            if ($request->hasFile('application_letter')) {
                $file_application = $request->file('application_letter')->store('public/documents');
            }
            if ($request->hasFile('agreement_letter')) {
                $file_agreement = $request->file('agreement_letter')->store('public/documents');
            }


            $childer = Childer::find($id);

            if (!$childer) {
                throw new Exception('Tanah bagian tidak ditemukan');
            }

            $childer->update([
                'parent_id' => $request->parent_id,
                'rental_retribution' => $request->rental_retribution,
                'utilization_engagement_type' => $request->utilization_engagement_type,
                'utilization_engagement_name' => $request->utilization_engagement_name,
                'allotment_of_use' => $request->allotment_of_use,
                'coordinate' => $request->coordinate,
                'large' => $request->large,
                'validity_period_of' => $request->validity_period_of,
                'validity_period_until' => $request->validity_period_until,
                'engagement_number' => $request->engagement_number,
                'engagement_date' => $request->engagement_date,
                'description' => $request->description,
                'application_letter' => $file_application,
                'agreement_letter' => $file_agreement,
                'year' => $request->year,
                'payment_amount' => $request->payment_amount,
                'proof_of_payment' => $request->proof_of_payment
            ]);
            $childer->save();

            if ($childer) :
                return ResponseFormatter::responseSuccessWithData('Berhasil update tanah bagian', $childer);
            else :
                return ResponseFormatter::responseError('Tanah bagian gagal di update', 400);
            endif;
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/childer/delete/{id}",
     *     tags={"Childers"},
     *     operationId="childerdelete",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function deleteChilder($id)
    {
        $parent = Childer::where([
            'id' => $id,
        ]);
        $parent->delete();
        return ResponseFormatter::responseSuccess('Berhasil hapus tanah bagian');
    }
}
