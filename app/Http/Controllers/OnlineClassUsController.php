<?php

namespace App\Http\Controllers;

use App\OnlineClassUs;
use App\MasterClass;
use App\GroupClass;
use App\Unit;
use App\Student;
use App\Http\Controllers\Controller;
use App\OnlineClass;
use App\OnlineClassTeacher;
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
         $online_class=OnlineClassUs::with('masterClass','online_class_teacher')->where(['created_by'=>Auth::id(),'school_id'=>$id])->orderBy('master_class_id', 'ASC')->get();
        
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
        //dd($teachers);
        return view('backEnd.online_class_us.create',compact('classes','group_classes','units','schools','teachers','school_id'));
    }
    
    public function add_multiple_teacher($id,$school_id)
    {
        
        if(!Auth::is('root')){
            return redirect('/home');
        }
        
        $teachers=Staff::with('teacher')->where('school_id',$school_id)->get();
        //dd($teachers);
        return view('backEnd.online_class_us.add_multiple_teacher',compact('teachers','id'));
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
                $data['teacher_id']=0;
                
                $online_class= OnlineClassUs::create($data);
                if (isset($request->teacher_id[$i])) {
                    OnlineClassTeacher::create(['online_class_us_id'=>$online_class->id,'teacher_id'=>$request->teacher_id[$i],'created_by'=>Auth::id()]);
                }
                $i++;
            }
        }
        return $this->returnWithSuccessRedirect('Data store successfuly','online_class_us/index/'.$request->school_id);
       
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
        $check_status=OnlineClassUs::where(['school_id'=>$school_id,'type'=>2])->first();
        if($check_status){
            return $this->returnWithSuccessRedirect('Data store successfuly','online_class_us/index/'.$school_id);
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
        return $this->returnWithSuccessRedirect('Data store successfuly','online_class_us/index/'.$school_id);
    }
    public function store_guardian($school_id)
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $check_status=OnlineClassUs::where(['school_id'=>$school_id,'type'=>3])->first();
        if($check_status){
            return $this->returnWithSuccessRedirect('Data store successfuly','online_class_us/index/'.$school_id);
        }
       //$data=$request->all();
       $data['created_by']=Auth::id();
       $data['school_id']=$school_id;
       $data['type']=3;
       $data['subject']=0;
        $data['master_class_id']=0;
        $data['group']=0;
        $data['section']=0;
        $data['shift']=0;
        $data['teacher_id']=0;
        OnlineClassUs::create($data);
        return $this->returnWithSuccessRedirect('Data store successfuly','online_class_us/index/'.$school_id);
    }
    public function add_multiple_teacher_store(Request $request)
    {
       $this->validate($request, [
            'teacher_id' => 'required',
        ]);
        $teacher=$request->teacher_id;
        $data=OnlineClassUs::where('id',$request->id)->first();
       if($teacher)
        {    foreach ($teacher as $row) {
            
                OnlineClassTeacher::create(['online_class_us_id'=>$request->id,'teacher_id'=>$row,'created_by'=>Auth::id()]);
            }
        }
        return $this->returnWithSuccessRedirect('Data store successfuly','online_class_us/index/'.$data->school_id);
       
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
    public function edit($oc_id,$school_id)
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
        $online_class=OnlineClassUs::where(['created_by'=>Auth::id(),'id'=>$oc_id])->first();
        return view('backEnd.online_class_us.edit',compact('online_class','classes','group_classes','units','teachers','school_id'));
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
            'master_class_id' => 'required',
        ]);
       
        if (!$request->group) {
            $data['group']=0;
        }
        if (!$request->section) {
            $data['section']=0;
        }
        if (!$request->shift) {
            $data['shift']=0;
        }
        if (!$request->subject) {
            $data['subject']=0;
        }
        if (!$request->master_class_id) {
            $data['master_class_id']=0;
        }
        if (!$request->teacher_id) {
            $data['teacher_id']=0;
        }
        
        
        OnlineClassUs::where(['id'=>$id,'created_by'=>Auth::id()])->update($data);
        return $this->returnWithSuccessRedirect('Data store successfuly','online_class_us/index/'.$request->school_id);
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
        return $this->returnWithSuccess('Data deleted successfuly !');
    }

    public function student_class()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $school=School::where(['id'=>Auth::getSchool(),'online_class_access'=>1])->first();
        if ($school) {
         $student_details=student::where(['school_id'=>Auth::getSchool(),'user_id'=>Auth::id()])->first();
         $online_class=OnlineClassUs::with('online_class_teacher')->where(['school_id'=>Auth::getSchool()])
         ->whereIn('master_class_id',[$student_details->master_class_id,'0'])
         ->whereIn('shift',[$student_details->shift,'0'])
         ->whereIn('group',[$student_details->group,'0'])
         ->whereIn('section',[$student_details->section,'0'])
         ->whereIn('type',[1,3])
         ->get();
        //dd($online_class);
        return view('backEnd.online_class_us.student_class',compact('online_class'));
        }else{
            return $this->returnWithErrorRedirect('You have no permission for conference !','/home');
        }
    }
    public function staff_class()
    {
        if(Auth::is('teacher')  || Auth::is('commitee') || Auth::is('staff')){
            
        }else{
            return redirect('/home');
        }
        $school=School::where(['id'=>Auth::getSchool(),'online_class_access'=>1])->first();
        if ($school) {
        $teacher_class=OnlineClassTeacher::where(['teacher_id'=>Auth::id()])->get();
        $conferance=OnlineClassUs::where(['school_id'=>Auth::getSchool()])->whereIn('type',[2,3])->get();
        //dd($teacher_class);
        return view('backEnd.online_class_us.teacher_class',compact('teacher_class','conferance'));
        }else{
            return $this->returnWithErrorRedirect('You have no permission for conference !','/home');
        }
    }

    public function school_class()
    {
       
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $school=School::where(['id'=>Auth::getSchool(),'online_class_access'=>1])->first();
        if ($school) {
        $school_id=Auth::getSchool();
        $online_class=OnlineClassUs::with('masterClass','online_class_teacher')->where(['school_id'=>Auth::getSchool()])->orderBy('master_class_id', 'ASC')->get();
        //dd($online_class);
        return view('backEnd.online_class_us.index',compact('online_class','school_id'));
        }else{
            return $this->returnWithErrorRedirect('You have no permission for conference !','/home');
        }
    }

    
    public function link()
    {
        $school=School::where(['id'=>Auth::getSchool(),'online_class_access'=>1])->first();
        if ($school) {
            return redirect('https://us.worldehsan.org/');
        }else{
            return $this->returnWithError('You have no permission for conference !');
        }
    }
}