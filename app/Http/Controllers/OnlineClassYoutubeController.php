<?php

namespace App\Http\Controllers;

use App\OnlineClassYoutube;
use App\MasterClass;
use App\GroupClass;
use App\Unit;
use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class OnlineClassYoutubeController extends Controller
{
    public function index()
    {
        if(!Auth::is('teacher')){
            return redirect('/home');
        }
        $online_class=OnlineClassYoutube::with('masterClass')->where(['created_by'=>Auth::id(),'school_id'=>Auth::getSchool()])->get();
        //dd($online_class);
        return view('backEnd.online_class_youtube.index',compact('online_class'));
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
        return view('backEnd.online_class_youtube.create',compact('classes','group_classes','units'));
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
            'master_class_id' => 'required',
            'group' => 'required',
            'shift' => 'required',
        ]);
        $data['created_by']=Auth::id();
        $data['school_id']=Auth::getSchool();
        OnlineClassYoutube::create($data);
        return $this->returnWithSuccessRedirect('Your information store successfully','online_class_youtube');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OnlineClassYoutube  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineClassYoutube $onlineClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlineClassYoutube  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function edit($oc_id)
    {
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $group_classes=GroupClass::all();
        $units=Unit::where('school_id',Auth::getSchool())->get();
        $online_class=OnlineClassYoutube::where(['created_by'=>Auth::id(),'school_id'=>Auth::getSchool(),'id'=>$oc_id])->first();
        return view('backEnd.online_class_youtube.edit',compact('online_class','classes','group_classes','units'));
    }
    public function view($oc_id)
    {
        
        $online_class=OnlineClassYoutube::where(['school_id'=>Auth::getSchool(),'id'=>$oc_id])->first();
        return view('backEnd.online_class_youtube.view',compact('online_class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlineClassYoutube  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
            'master_class_id' => 'required',
            'group' => 'required',
            'shift' => 'required',
        ]);
        
        OnlineClassYoutube::where(['id'=>$id,'created_by'=>Auth::id(),'school_id'=>Auth::getSchool()])->update($data);
        return $this->returnWithSuccessRedirect('Your information store successfully !','online_class_youtube');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlineClassYoutube  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OnlineClassYoutube::where(['id'=>$id,'created_by'=>Auth::id(),'school_id'=>Auth::getSchool()])->delete();
        return $this->returnWithSuccessRedirect('Your information deleted successfully !','online_class_youtube');
    }

    public function student_class()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $student_details=student::where(['school_id'=>Auth::getSchool(),'user_id'=>Auth::id()])->first();
        $online_class=OnlineClassYoutube::where(['master_class_id'=>$student_details->master_class_id,'shift'=>$student_details->shift,'group'=>$student_details->group])->get();
        //dd($online_class);
        return view('backEnd.online_class_youtube.student_class',compact('online_class'));
    }
}
