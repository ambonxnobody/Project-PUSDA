<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PaymentController extends Controller
{
    // protected $user;
    // public function __construct()
    // {
    //     $this->user = JWTAuth::parseToken()->authenticate();
    // }


    /**
     * @OA\Get(
     *     path="/api/payment",
     *     tags={"Payments"},
     *     operationId="payments",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */


    public function getAll(Request $request)
    {
        $parent_query = Payment::with(['childer'])
            ->paginate(10);

        return ResponseFormatter::responseSuccessWithData('Sukses mendapatkan data pemabayaran', $parent_query);
    }

    public function getAllPayment(Request $request)
    {
        $childrens_id = $request->input('childrens_id');
        $payment_query = Payment::with(['childer']);

        $payments = $payment_query;

        if ($childrens_id) {
            $payments->whereHas('childer', function ($query) use ($childrens_id) {
                $query->where('childrens_id', $childrens_id);
            });
        }

        return ResponseFormatter::responseSuccessWithData('Sukses mendapatkan data pemabayaran', $payments->orderBy('id', 'DESC')->paginate(10));
    }

    public function getById(Request $request, $id)
    {
        $parent_query = Payment::with(['childer'])
            ->where('id', $id)
            ->first();


        return ResponseFormatter::responseSuccessWithData('Berhasil', $parent_query);
    }




    /**
     * @OA\Post(
     *     path="/api/payment/create",
     *     tags={"Payments"},
     *     operationId="paymentadd",
     *     @OA\Parameter(
     *          name="childrens_id",
     *          description="childrens_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="year ",
     *          description="year ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="proof_of_payment",
     *          description="proof_of_payment",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="date"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="payment_amount",
     *          description="payment_amount",
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
    public function createPayment(Request $request)
    {
        $validation = Validator::make($request->only('childrens_id', 'year', 'proof_of_payment', 'payment_amount'), [
            'childrens_id' => 'required|integer',
            'year' => 'required',
            'proof_of_payment' => 'required|mimes:doc,docx,pdf,txt,jpg,jpeg,bmp,png',
            'payment_amount' => 'required'
        ]);

        if ($validation->fails()) :
            return ResponseFormatter::responseValidation($validation->errors());
        endif;

        try {

            if ($request->hasFile('proof_of_payment')) {
                $file = $request->file('proof_of_payment')->store('public/documents/proofofpayment');
            }

            $payment = Payment::create([
                'childrens_id' => $request->childrens_id,
                'year' => $request->year,
                'proof_of_payment' => $file,
                'payment_amount' => $request->payment_amount,
            ]);

            $data = Payment::where('id', $payment->id)->with(['childer'])->get();

            if ($data) :
                return ResponseFormatter::responseCreated('Successfully created new payment!', $data);
            else :
                return ResponseFormatter::responseError('Payment not created', 400);
            endif;
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/payment/update/{id}",
     *     tags={"Payments"},
     *     operationId="paymentupdate",
     *     @OA\Parameter(
     *          name="childrens_id",
     *          description="childrens_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="year ",
     *          description="year ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="proof_of_payment",
     *          description="proof_of_payment",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="date"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="payment_amount",
     *          description="payment_amount",
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
    public function updatePayment(Request $request, $id)
    {
        try {
            if ($request->hasFile('proof_of_payment')) {
                $file = $request->file('proof_of_payment')->store('public/documents');
            }

            $parent = Payment::findOrFail($id);
            $parent->update([
                'childrens_id' => $request->childrens_id,
                'year' => $request->year,
                'proof_of_payment' => $file,
                'payment_amount' => $request->payment_amount,
            ]);
            $parent->save();

            if ($parent) :
                return ResponseFormatter::responseSuccessWithData('Successfully update parent', $parent);
            else :
                return ResponseFormatter::responseError('Payment not updated', 400);
            endif;
        } catch (Exception $error) {
            return ResponseFormatter::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/payment/delete/{id}",
     *     tags={"Payments"},
     *     operationId="paymentdelete",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function deletePayment($id)
    {
        $parent = Payment::where([
            'id' => $id,
        ]);
        $parent->delete();
        return ResponseFormatter::responseSuccess('Successfully deleting parent');
    }
}
