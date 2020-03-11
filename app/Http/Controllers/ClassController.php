<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MasterClass;
use DB;
use Session;
use App\SchoolType;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes =MasterClass::with('schoolType')->get();
        return view('backEnd.classManage.all_class_info',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $school_types= self::getSchoolTypes();
     return view('backEnd.classManage.create',compact('school_types'));
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
            'name'=>'required',
            'school_type_id'=>'required'
        ]);
        if ($this->createCheck($request->name)){
            Session::flash('errmgs', 'শ্রেণীটি পূর্বেই যোগ করা হয়েছে !');
            return redirect()->back();
        }
        $data['name']=$request->name;
        $data['school_type_id']=$request->school_type_id;
        MasterClass::insert($data);
        Session::flash('sccmgs', 'শ্রেণী সফলভাবে যোগ করা হয়েছে !');
        return redirect()->back();
    }
    public function createCheck($name){
        $result=MasterClass::where(['name'=>$name])->first();
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class= MasterClass::where(['id'=>$id])->first();
        $school_types= self::getSchoolTypes();
        return view('backEnd.classManage.edit', compact('class','school_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'school_type_id'=>'required'
        ]);
        if ($this->createCheck($request->name)->count() > 0 && $this->createCheck($request->name)->id != $request->class_id){
            Session::flash('errmgs', 'শ্রেণীটি পূর্বেই যোগ করা হয়েছে ! !');
            return redirect()->back();
        }
        $data['name']=$request->name;
        $data['school_type_id']=$request->school_type_id;
        MasterClass::where(['id'=>$request->class_id])->update($data);
        Session::flash('sccmgs', 'শ্রেণীটি সফলভাবে আপডেট করা হয়েছে ! !');
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
        MasterClass::where(['id'=>$id])->delete();
        Session::flash('sccmgs', 'শ্রেণীটি সফলভাবে মুছে ফেলা হয়েছে !');
        return redirect()->back();
    }

    public static function getSchoolTypes()
    {
        $school_types=SchoolType::all();
        return $school_types;
    }
}
