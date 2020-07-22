<?php

namespace App\Http\Controllers;

use App\OnlineClassUs;
use App\MasterClass;
use App\GroupClass;
use App\Unit;
use App\Student;
use App\Http\Controllers\Controller;
use App\School;
use App\Staff;
use Illuminate\Http\Request;
use Auth;

class OnlineClassUsController extends Controller
{
    public function index($id)
    {
       
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $school_id=$id;
        $online_class=OnlineClassUs::with('masterClass')->where(['created_by'=>Auth::id(),'school_id'=>$id])->orderBy('master_class_id', 'ASC')->get();
        //dd($online_class);
        return view('backEnd.online_class_us.index',compact('online_class','school_id'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($school_id)
    {
        
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $school = School::where('id',$school_id)->first();
        $id = $school->school_type_id;
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $group_classes=GroupClass::all();
        $units=Unit::where('school_id',$school_id)->get();
        $teachers=Staff::with('teacher')->where('school_id',$school_id)->get();
        return view('backEnd.online_class_us.create',compact('classes','group_classes','units','schools','teachers','school_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data1=$request->all();
       $this->validate($request, [
            'master_class_id' => 'required',
        ]);
       $data['created_by']=Auth::id();
       $data['school_id']=$request->school_id;
       $data['type']=1;
        $class=$request->master_class_id;
       $i=0;
       if($class)
        {    foreach ($class as $row) {
                if (isset($request->group[$i])) {
                    $data['group']=$request->group[$i];
                }else{
                    $data['group']=0;
                }
                if (isset($request->section[$i])) {
                    $data['section']=$request->section[$i];
                }else{
                    $data['section']=0;
                }
                if (isset($request->shift[$i])) {
                    $data['shift']=$request->shift[$i];
                }else{
                    $data['shift']=0;
                }
                if (isset($request->subject[$i])) {
                    $data['subject']=$request->subject[$i];
                }else{
                    $data['subject']=0;
                }
                if (isset($request->master_class_id[$i])) {
                    $data['master_class_id']=$request->master_class_id[$i];
                }else{
                    $data['master_class_id']=0;
                }
                if (isset($request->teacher_id[$i])) {
                    $data['teacher_id']=$request->teacher_id[$i];
                }else{
                    $data['teacher_id']=0;
                }
                $i++;
                OnlineClassUs::create($data);
            }
        }
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','online_class_us/index/'.$request->school_id);
       
    }
    /* public function create($school_id)
    {
        
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $school = School::where('id',$school_id)->first();
        $id = $school->school_type_id;
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $group_classes=GroupClass::all();
        $units=Unit::where('school_id',$school_id)->get();
        $teachers=Staff::with('teacher')->where('school_id',$school_id)->get();
        return view('backEnd.online_class_us.create',compact('classes','group_classes','units','schools','teachers','school_id'));
    } */
    public function store_staff($school_id)
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $check_status=OnlineClassUs::where('school_id',$school_id)->first();
        if($check_status){
            return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','online_class_us/index/'.$school_id);
        }
       //$data=$request->all();
       $data['created_by']=Auth::id();
       $data['school_id']=$school_id;
       $data['type']=2;
       $data['subject']=0;
        $data['master_class_id']=0;
        $data['group']=0;
        $data['section']=0;
        $data['shift']=0;
        $data['teacher_id']=0;
        OnlineClassUs::create($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','online_class_us/index/'.$school_id);
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
                // 'group' => 'required',
                // 'section' => 'required',
                // 'shift' => 'required',
            ]);
            
        }
        if (!$request->group) {
            $data['group']=0;
        }
        if (!$request->section) {
            $data['section']=0;
        }
        if (!$request->shift) {
            $data['shift']=0;
        }
        if ($request->type==2  ) {
            $data['subject']=0;
            $data['master_class_id']=0;
            $data['group']=0;
            $data['section']=0;
            $data['shift']=0;
        }
        
        OnlineClassUs::where(['id'=>$id,'created_by'=>Auth::id()])->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','online_class_us/index/'.$request->school_id);
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
        return $this->returnWithSuccess('আপনার তথ্য মুছেফেলা হয়েছে !');
    }

    public function student_class()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
         $student_details=student::where(['school_id'=>Auth::getSchool(),'user_id'=>Auth::id()])->first();
         $online_class=OnlineClassUs::where(['master_class_id'=>$student_details->master_class_id,'school_id'=>Auth::getSchool(),'type'=>1])
         ->whereIn('shift',[$student_details->shift,'0'])
         ->whereIn('group',[$student_details->group,'0'])
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
        $online_class=OnlineClassUs::where(['school_id'=>Auth::getSchool(),'type'=>2])->whereIn('teacher_id',[Auth::id(),'0'])->get();
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
