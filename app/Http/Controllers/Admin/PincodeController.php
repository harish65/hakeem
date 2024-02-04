<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Pincode;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PincodeImport;
use App\Exports\PincodeExport;
use App\Http\Traits\CategoriesTrait;
use DateTime;
use DateTimeZone;
use Config;

class PincodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pincodes = Pincode::orderBy('id', 'DESC')->get();
        return view('admin.pincodes.index')->with(array('pincodes'=>$pincodes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pincodes.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $msg = [];
        $rule = [
                'pincode' => 'required',
          ];
         
        $validator = \Validator::make($request->all(), $rule, $msg);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
         
          
        $pincode = new Pincode();
        $pincode->pincode = $input['pincode'];
        $pincode->save();
        return redirect('admin/pincodes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function show(Pincode $pincode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function edit(Pincode $pincode)
    {
        return view('admin.pincodes.edit', compact('pincode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pincode $pincode)
    {
        $input = $request->all();
        $msg = [];
        $rule = [
                'pincode' => 'required',
          ];
        
        $validator = \Validator::make($request->all(), $rule, $msg);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
       
        $pincode->pincode = $input['pincode'];
        $pincode->save();
        return redirect('admin/pincodes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pincode $pincode)
    {
        if ($pincode->delete()) {
            return response()->json(['status'=>'success']);
        } else {
            return response()->json(['status'=>'error']);
        }
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request)
    {
        if($request->file('file')){
          Excel::import(new PincodeImport, $request->file('file')->store('temp'));
          return back();
        }
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport()
    {
        return Excel::download(new PincodeExport, 'pincodes-example.xlsx');
    }
}
