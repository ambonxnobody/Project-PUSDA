<?php

namespace App\Http\Controllers\Upt;

use App\Http\Controllers\Controller;
use App\Models\Childer;
use Illuminate\Http\Request;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UptKediriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Parents::orderBy('id','desc')
        ->where('auhtor',Auth::user()->roles()->pluck('id'))
        ->paginate(10);
        return view('upt.upt_kediri.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upt.upt_kediri.create');
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
            'no_reg' => 'required|string|unique:parents,no_reg',
            'name_goods' => 'required|string',
            'address' => 'required|string',
            'village' => 'required|string',
            'kec' => 'required|string',
            'kab_city' => 'required|string',
            'no' => 'required|string|unique:parents,no',
            'date' => 'required|string',
            'large' => 'required|string',
        ]);

        // dd($request->all());

        try {
            $parents = new Parents;
            $parents->no_reg = $request->no_reg;
            $parents->auhtor  = $request->auhtor;
            $parents->name_goods = $request->name_goods;
            $parents->address = $request->address;
            $parents->village = $request->village;
            $parents->kec = $request->kec;
            $parents->kab_city = $request->kab_city;
            $parents->no = $request->no;
            $parents->date = $request->date;
            $parents->large = $request->large;
            $parents->save();

            Alert::success('Success', 'Your data has been successfully created');
            return redirect()->route('kediri.index');

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
        return view('upt.upt_kediri.detail',compact('parent','childer'));
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
        return view('upt.upt_kediri.edit',compact('parent'));
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
            'no_reg' => 'required|string|unique:parents,no_reg,'.$id,
            'name_goods' => 'required|string',
            'address' => 'required|string',
            'village' => 'required|string',
            'kec' => 'required|string',
            'kab_city' => 'required|string',
            'no' => 'required|string|unique:parents,no,'.$id,
            'date' => 'required|string',
            'large' => 'required|string',
        ]);
    // dd($request->all());

        try {

            $no_reg = $request->input('no_reg');
            $auhtor = $request->input('auhtor');
            $name_goods = $request->input('name_goods');
            $address = $request->input('address');
            $village = $request->input('village');
            $kec = $request->input('kec');
            $kab_city = $request->input('kab_city');
            $no = $request->input('no');
            $date = $request->input('date');
            $large = $request->input('large');

            $parents = Parents::find($id);
            $parents->no_reg = $no_reg;
            $parents->auhtor  = $auhtor;
            $parents->name_goods = $name_goods;
            $parents->address = $address;
            $parents->village = $village;
            $parents->kec = $kec;
            $parents->kab_city = $kab_city;
            $parents->no = $no;
            $parents->date = $date;
            $parents->large = $large;
            $parents->update();

            Alert::success('Success', 'Your data has been successfully updated');
            return redirect()->route('kediri.index');

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
        //
    }
}
