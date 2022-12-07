<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Childer;
use App\Models\Parents;
use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class childersController extends Controller
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
        $parent = Parents::where('id',$id)->first();
        return view('admin.soil.childern.create',compact('parent'));
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
            'parent_id' => 'required',
            'rental_retribution'=> 'required|string',
            'utilization_engagement_type'=> 'required|string',
            'utilization_engagement_name'=> 'required|string',
            'allotment_of_use'=> 'required|string',
            'coordinate'=> 'required|string',
            'large'=> 'required|string',
            'validity_period_of'=> 'required|string',
            'validity_period_until'=> 'required|string',
            'engagement_number'=> 'required|string',
            'engagement_date'=> 'required|string',
            'application_letter'=> 'required|mimes:pdf',
            'agreement_letter'=> 'required|mimes:pdf',

        ]);
        // dd($request->all());

        try {
            $clid = new Childer();

            $fileletterapplicName = time().'.'.$request->application_letter->extension();
            $path = public_path('documents/applicationletter');
            if(!empty($clid->application_letter) && file_exists($path.'/'.$clid->application_letter)) :
                unlink($path.'/'.$clid->application_letter);
            endif;
            $clid->application_letter = $fileletterapplicName;

            $fileagreementLetterName = time().'.'.$request->agreement_letter->extension();
            $path = public_path('documents/agreementletter');
            if(!empty($clid->agreement_letter) && file_exists($path.'/'.$clid->agreement_letter)) :
                unlink($path.'/'.$clid->agreement_letter);
            endif;
            $clid->agreement_letter = $fileagreementLetterName;


            $clid->parent_id = $request->parent_id;
            $clid->rental_retribution = $request->rental_retribution;
            $clid->utilization_engagement_type = $request->utilization_engagement_type;
            $clid->utilization_engagement_name = $request->utilization_engagement_name;
            $clid->coordinate = $request->coordinate;
            $clid->large = $request->large;
            $clid->allotment_of_use = $request->allotment_of_use;
            $clid->validity_period_of = $request->validity_period_of;
            $clid->validity_period_until = $request->validity_period_until;
            $clid->engagement_number = $request->engagement_number;
            $clid->engagement_date = $request->engagement_date;
            $clid->save();

            $request->application_letter->move(public_path('documents/applicationletter'), $fileletterapplicName);
            $request->agreement_letter->move(public_path('documents/agreementletter'), $fileagreementLetterName);

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
        $chil = Childer::where('id',$id)->first();
        return view('admin.soil.childern.detail',compact('chil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chil = Childer::where('id',$id)->first();
        return view('admin.soil.childern.edit',compact('chil'));
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
        $request->validate([
            'rental_retribution'=> 'required|string',
            'utilization_engagement_type'=> 'required|string',
            'utilization_engagement_name'=> 'required|string',
            'allotment_of_use'=> 'required|string',
            'coordinate'=> 'required|string',
            'large'=> 'required|string',
            'validity_period_of'=> 'required|string',
            'validity_period_until'=> 'required|string',
            'engagement_number'=> 'required|string',
            'engagement_date'=> 'required|string',

        ]);



            $parent_id = $request->input('parent_id');
            $rental_retribution = $request->input('rental_retribution');
            $utilization_engagement_type = $request->input('utilization_engagement_type');
            $utilization_engagement_name = $request->input('utilization_engagement_name');
            $allotment_of_use = $request->input('allotment_of_use');
            $coordinate = $request->input('coordinate');
            $large = $request->input('large');
            $validity_period_of = $request->input('validity_period_of');
            $validity_period_until = $request->input('validity_period_until');
            $engagement_number = $request->input('engagement_number');
            $engagement_date = $request->input('engagement_date');


            $clid = Childer::find($id);

                $fileletterapplicName = time().'.'.$request->application_letter->extension();

                $path = public_path('documents/applicationletter');

                if(!empty($clid->application_letter) && file_exists($path.'/'.$clid->application_letter)) :
                    unlink($path.'/'.$clid->application_letter);
                endif;

                $clid->application_letter = $fileletterapplicName;

                $fileagreementLetterName = time().'.'.$request->agreement_letter->extension();

                $path = public_path('documents/agreementletter');

                if(!empty($clid->agreement_letter) && file_exists($path.'/'.$clid->agreement_letter)) :
                    unlink($path.'/'.$clid->agreement_letter);
                endif;

                $clid->agreement_letter = $fileagreementLetterName;

                $clid->parent_id = $parent_id;
                $clid->rental_retribution = $rental_retribution;
                $clid->utilization_engagement_type = $utilization_engagement_type;
                $clid->utilization_engagement_name = $utilization_engagement_name;
                $clid->allotment_of_use = $allotment_of_use;
                $clid->coordinate = $coordinate;
                $clid->large = $large;
                $clid->validity_period_of = $validity_period_of;
                $clid->validity_period_until = $validity_period_until;
                $clid->engagement_number = $engagement_number;
                $clid->engagement_date = $engagement_date;

            $clid->update();

            $request->application_letter->move(public_path('documents/applicationletter'), $fileletterapplicName);
            $request->agreement_letter->move(public_path('documents/agreementletter'), $fileagreementLetterName);

            Alert::success('Success', 'Your data has been successfully updated');
            return redirect()->route('soil.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $chil = Childer::find($id);
            $chil->delete();
            Alert::success('Success', 'Your data has been successfully delete');
            return redirect()->back();
        }catch (\Throwable $th) {
            Alert::error('Failed','Opsss... Failed to created your data', ['error' => $th->getMessage()]);
        }
        return redirect()->back();
    }
}
