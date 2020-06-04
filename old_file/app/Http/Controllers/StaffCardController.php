<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\School;
use Illuminate\Support\Facades\Auth;
use \Milon\Barcode\DNS1D;
use QrCode;

class StaffCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        return view('backEnd.idcard.staffCard.index',compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $staff = '';
        if(isset($request->staff_id)){
           $staff= Staff::where(['staff_id'=>$request->staff_id,'school_id'=>$request->school_id])->current()->first();
        }else{
           $staffs= Staff::where(['school_id'=>$request->school_id])->current()->get();
        } 
        $school=School::where('id',$request->school_id)->select('school_type_id')->first();
        $school_type_ids=explode('|', $school->school_type_id);
        return view('backEnd.idcard.staffCard.create',compact('staff','staffs','school_type_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
