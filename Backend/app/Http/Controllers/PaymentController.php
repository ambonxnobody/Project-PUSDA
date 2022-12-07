<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Childer;
use App\Models\Parents;
use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $chil = Childer::where('id',$id)->first();
        return view('admin.soil.payment.create',compact('chil'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'childrens_id' => 'required',
            'year'=> 'required|string',
            'payment_amount'=> 'required|string',
            'proof_of_payment'=> 'required|mimes:pdf',
        ]);

        try {

            $payment = new Payment();
            //  proof_of_payment
            $filepaymentName = time().'.'.$request->proof_of_payment->extension();
            $path = public_path('documents/proofofpayment');
            if(!empty($payment->proof_of_payment) && file_exists($path.'/'.$payment->proof_of_payment)) :
                unlink($path.'/'.$payment->proof_of_payment);
            endif;
            $payment->proof_of_payment = $filepaymentName;

            $payment->childrens_id = $request->childrens_id;
            $payment->year = $request->year;
            $payment->payment_amount = $request->payment_amount;

             $payment->save();
             $request->proof_of_payment->move(public_path('documents/proofofpayment'), $filepaymentName);
            Alert::success('Success', 'Your data has been successfully created');
            return redirect()->back();

           }catch (\Throwable $e) {
            Alert::error('Error','Failed to created your data',['error' => $e->getMessage()]);
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
