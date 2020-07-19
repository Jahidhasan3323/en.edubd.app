<?php

namespace App\Http\Controllers;

use App\OnlineClassUs;
use App\MasterClass;
use App\GroupClass;
use App\Unit;
use App\Student;
use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;
use Auth;

class OnlineClassUsController extends Controller
{
    public function index($id)
    {
       
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $online_class=OnlineClassUs::with('masterClass')->where(['created_by'=>Auth::id(),'school_id'=>$id])->orderBy('master_class_id', 'ASC')->get();
        //dd($online_class);
        return view('backEnd.online_class_us.index',compact('online_class'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        
        if(!Auth::is('root')){
            return redirect('/home');
        }
        /* $id=Auth::schoolType();
        $school_type_ids=explode('|', $id); */
        $schools = School::get();
        $classes = MasterClass::get();
        $group_classes=GroupClass::all();
        $units=Unit::get();
        return view('backEnd.online_class_us.create',compact('classes','group_classes','units','schools'));
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
            'school_id' => 'required',
            'type' => 'required',
        ]);
       if ($request->type==1) {
        
            $this->validate($request, [
                'subject' => 'required',
                'master_class_id' => 'required',
                'group' => 'required',
                'shift' => 'required',
            ]);
            if (!$request->section) {
                $data['section']=0;
            }
        }
        if ($request->type==2  ) {
            $data['subject']=0;
            $data['master_class_id']=0;
            $data['group']=0;
            $data['section']=0;
            $data['shift']=0;
        }
        $data['created_by']=Auth::id();
        OnlineClassUs::create($data);
        return $this->returnWithSuccessRedirect('Data store successfully','online_class_us/index/'.$request->school_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OnlineClassUs  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineClassUs $onlineClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlineClassUs  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function edit($oc_id)
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
        /* $id=Auth::schoolType();
        $school_type_ids=explode('|', $id );*/
        $schools = School::get();
        $classes = MasterClass::get();
        $group_classes=GroupClass::all();
        $units=Unit::get();
        $online_class=OnlineClassUs::where(['created_by'=>Auth::id(),'id'=>$oc_id])->first();
        return view('backEnd.online_class_us.edit',compact('online_class','classes','group_classes','units','schools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlineClassUs  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $this->validate($request, [
            
            'school_id' => 'required',
            'type' => 'required',
        ]);
       if ($request->type==1) {
        
            $this->validate($request, [
                'subject' => 'required',
                'master_class_id' => 'required',
                'group' => 'required',
                'shift' => 'required',
            ]);
            if (!$request->section) {
                $data['section']=0;
            }
        }
        if ($request->type==2  ) {
            $data['subject']=0;
            $data['master_class_id']=0;
            $data['group']=0;
            $data['section']=0;
            $data['shift']=0;
        }
        
        OnlineClassUs::where(['id'=>$id,'created_by'=>Auth::id()])->update($data);
        return $this->returnWithSuccessRedirect('Data store successfully !','online_class_us/index/'.$request->school_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlineClassUs  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
        OnlineClassUs::where(['id'=>$id,'created_by'=>Auth::id()])->delete();
        return $this->returnWithSuccess('Data deleted successfully !');
    }

    public function student_class()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }

        $school=School::where(['id'=>Auth::getSchool(),'online_class_access'=>1])->first();
        if (!$school) {

            return $this->returnWithError(' You have no acces in Ehsan online conferance syatem !');

        }
         $student_details=student::where(['school_id'=>Auth::getSchool(),'user_id'=>Auth::id()])->first();
         $online_class=OnlineClassUs::where(['master_class_id'=>$student_details->master_class_id,'shift'=>$student_details->shift,'group'=>$student_details->group,'school_id'=>Auth::getSchool(),'type'=>1])
         ->whereIn('section',[$student_details->section,'0'])
         ->get();
        //dd($online_class);
        return view('backEnd.online_class_us.student_class',compact('online_class'));
    }
    public function staff_class()
    {
        if(Auth::is('teacher') || Auth::is('admin') || Auth::is('commitee') || Auth::is('staff')){
            
        }else{
            return redirect('/home');
        }

        $school=School::where(['id'=>Auth::getSchool(),'online_class_access'=>1])->first();
        if (!$school) {

            return $this->returnWithError(' You have no acces in Ehsan online conferance syatem !');

        }
        $online_class=OnlineClassUs::where(['school_id'=>Auth::getSchool(),'type'=>2])->get();
        //dd($online_class);
        return view('backEnd.online_class_us.teacher_class',compact('online_class'));
    }
    
    public function link()
    {
        $school=School::where(['id'=>Auth::getSchool(),'online_class_access'=>1])->first();
        if ($school) {
            return redirect('https://us.worldehsan.org/');
        }else{
            return $this->returnWithError(' ইহসান অনলাইন কনফারেন্সে আপনার অনুমতি নেই !');
        }
    }
}
