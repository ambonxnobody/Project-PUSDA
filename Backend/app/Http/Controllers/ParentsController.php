<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Childer;
use App\Models\Parents;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Parents::orderBy('id','desc')
        ->paginate(10);
        return view('admin.soil.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.soil.create');
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
            'certificate_number' => 'required|string|unique:parents,certificate_number',
            'certificate_date' => 'required|string',
            'utilization_type' => 'required|string',
            'address' => 'required|string',
            'large' => 'required|string',
        ]);

        // dd($request->all());

        try {
            $parents = new Parents;
            $parents->certificate_number = $request->certificate_number;
            $parents->auhtor  = $request->auhtor;
            $parents->certificate_date = $request->certificate_date;
            $parents->address = $request->address;
            $parents->utilization_type = $request->utilization_type;
            $parents->large = $request->large;
            $parents->save();

            Alert::success('Success', 'Your data has been successfully created');
            return redirect()->route('soil.index');

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
        $parent = Parents::where('id',$id)->first();

        $childer = Childer::orderBy('id','desc')
        ->where('parent_id',$parent->id)
        ->paginate(10);

        // $payment = Payment::orderBy('id','desc')
        // ->where('childrens_id',$id)
        // ->get();

        return view('admin.soil.detail',compact('parent','childer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent = Parents::where('id',$id)->first();
        return view('admin.soil.edit',compact('parent'));
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
            'certificate_number' => 'required|string|unique:parents,certificate_number,'.$id,
            'certificate_date' => 'required|string',
            'utilization_type' => 'required|string',
            'address' => 'required|string',
            'large' => 'required|string',
        ]);
    // dd($request->all());

        try {

            $certificate_number = $request->input('certificate_number');
            $certificate_date = $request->input('certificate_date');
            $utilization_type = $request->input('utilization_type');
            $auhtor = $request->input('auhtor');
            $address = $request->input('address');
            $large = $request->input('large');

            $parents = Parents::find($id);
            $parents->certificate_number = $certificate_number;
            $parents->auhtor  = $auhtor;
            $parents->certificate_date = $certificate_date;
            $parents->utilization_type = $utilization_type;
            $parents->address = $address;
            $parents->large = $large;
            $parents->update();

            Alert::success('Success', 'Your data has been successfully updated');
            return redirect()->route('soil.index');

           }catch (\Throwable $e) {
            Alert::error('Error','Failed to created your data',['error' => $e->getMessage()]);
        }
        return redirect()->back();
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
            $export = Parents::find($id);

            $export->delete();
            Alert::success('Success', 'Data Induk Berhasil Dihapus');
            return redirect()->back();
        }catch (\Throwable $th) {
            Alert::error('Failed','Opsss... Gagal Dihapus', ['error' => $th->getMessage()]);
        }
        return redirect()->back();
    }
}
