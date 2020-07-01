<?php

namespace App\Http\Controllers;

use App\OnlineClass;
use App\MasterClass;
use App\GroupClass;
use App\Unit;
use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class OnlineClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::is('teacher')){
            return redirect('/home');
        }
        $online_class=OnlineClass::with('masterClass')->where(['created_by'=>Auth::id(),'school_id'=>Auth::getSchool()])->get();
        //dd($online_class);
        return view('backEnd.online_class.index',compact('online_class'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $group_classes=GroupClass::all();
        $units=Unit::where('school_id',Auth::getSchool())->get();
        return view('backEnd.online_class.create',compact('classes','group_classes','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data=$request->all();
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
            'password' => 'required',
            'master_class_id' => 'required',
            'group' => 'required',
            'section' => 'required',
            'shift' => 'required',
        ]);
        $data['created_by']=Auth::id();
        $data['school_id']=Auth::getSchool();
        OnlineCLass::create($data);
        return $this->returnWithSuccessRedirect('Your information store successfully','online_class');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OnlineClass  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineClass $onlineClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlineClass  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function edit($oc_id)
    {
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $group_classes=GroupClass::all();
        $units=Unit::where('school_id',Auth::getSchool())->get();
        $online_class=OnlineClass::where(['created_by'=>Auth::id(),'school_id'=>Auth::getSchool(),'id'=>$oc_id])->first();
        return view('backEnd.online_class.edit',compact('online_class','classes','group_classes','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlineClass  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
            'password' => 'required',
            'master_class_id' => 'required',
            'group' => 'required',
            'section' => 'required',
            'shift' => 'required',
        ]);
        
        OnlineClass::where(['id'=>$id,'created_by'=>Auth::id(),'school_id'=>Auth::getSchool()])->update($data);
        return $this->returnWithSuccessRedirect('Your information store successfully !','online_class');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlineClass  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OnlineClass::where(['id'=>$id,'created_by'=>Auth::id(),'school_id'=>Auth::getSchool()])->delete();
        return $this->returnWithSuccessRedirect('Your information deleted successfully !','online_class');
    }

    public function student_class()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $student_details=student::where(['school_id'=>Auth::getSchool(),'user_id'=>Auth::id()])->first();
        $online_class=OnlineClass::where(['master_class_id'=>$student_details->master_class_id,'shift'=>$student_details->shift,'group'=>$student_details->group])->get();
        //dd($online_class);
        return view('backEnd.online_class.student_class',compact('online_class'));
    }
}
