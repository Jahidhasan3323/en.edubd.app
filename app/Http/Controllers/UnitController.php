<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Unit;
use DB;
use Session;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::where('school_id', Auth::getSchool())->paginate(10);
        return view('backEnd.unitManage.all_unit_info',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backEnd.unitManage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        if ($this->createCheck($request->name)){
            Session::flash('errmgs', 'শাখাটি পূর্বেই যোগ করা হয়েছে !');
            return redirect()->back();
        }
        $data['name']=strtoupper($request->name);
        $data['school_id']=Auth::getSchool();
        Unit::create($data);
        Session::flash('sccmgs', 'শাখা সফলভাবে যোগ করা হয়েছে !');
            return redirect()->back();
    }

    public function createCheck($name){
        $result=Unit::where(['name'=>$name, 'school_id'=>Auth::getSchool()])->first();
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit= Unit::where(['id'=>$id, 'school_id'=>Auth::getSchool()])->select(['id','name'])->first();
        return view('backEnd.unitManage.edit',compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        if ($this->createCheck($request->name)){
            Session::flash('errmgs', 'শাখাটি পূর্বেই যোগ করা হয়েছে !');
            return redirect()->back();
        }
        $data['name']=$request->name;
        Unit::where(['id'=>$request->unit_id,'school_id'=>Auth::getSchool()])->update($data);
        Session::flash('sccmgs', 'শাখা সফলভাবে আপডেট করা হয়েছে !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::where(['id'=>$id,'school_id'=>Auth::getSchool()])->delete();
        Session::flash('sccmgs', 'শাখা সফলভাবে মুছে ফেলা হয়েছে !');
            return redirect()->back();
    }
}
