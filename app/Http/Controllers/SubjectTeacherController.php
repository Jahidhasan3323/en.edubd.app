<?php

namespace App\Http\Controllers;
use App\Unit;
use App\Subject;
use App\SubjectTeacher;
use App\Staff;
use App\GroupClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;

class SubjectTeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student') && !Auth::is('commitee') && !Auth::is('staff')){
            return redirect('/home');
        }
        $statisticsData = SubjectTeacher::with('masterClass','groupClass')
                          ->where(['school_id'=>Auth::getSchool()])
                          ->groupBy('master_class_id','shift','section','group_class_id')
                          ->selectRaw('id, master_class_id,shift,section,group_class_id, count(subject_id) as subjects, count(staff_id) as teachers')
                          ->get();
        return view('backEnd.subjectsTeachers.index', compact('statisticsData'));
    }

    public function show($master_class_id, $shift, $section, $group_class_id){
       $data['master_class_id'] = $master_class_id;
       $data['shift'] = $shift;
       $data['section'] = $section;
       $data['group_class_id'] = $group_class_id;
       $data['school_id'] = Auth::getSchool();
       $statisticsData = SubjectTeacher::with('staff.user','masterClass','subject','groupClass')->where($data)->get();
       return view('backEnd.subjectsTeachers.show', compact('statisticsData'));
    }

    public function create()
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $classes = $this->getClasses();
        $units =$this->getUnits();
        $class_groups=GroupClass::all();
        $teachers=Staff::join('users','staff.user_id', '=', 'users.id')
                        ->where('users.group_id', 3)
                        ->where('staff.school_id', Auth::getSchool())
                        ->select('staff.id','users.name as name','staff.subject as subject')
                        ->get();
        return view('backEnd.subjectsTeachers.assign', compact('classes','units','class_groups','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $this->validationCheck($request);
        $duplicateCheck=$this->duplicateCheck($request);
        if ($duplicateCheck){
          Session::flash('errmgs', 'দুঃখিত, বিষয়টি পূর্বেই এসাইন করা হয়েছে !');
          return redirect()->back();
        }
        try{
            $data = $request->all();
            $data['school_id']= Auth::getSchool();
            SubjectTeacher::create($data);
            Session::flash('sccmgs', 'বিষয় সফলভাবে যোগ করা হয়েছে !');
            return redirect()->back();
        }catch (\Exception $e){
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }


    protected function validationCheck($request){
      $this->validate($request, [
            'staff_id'=>'required',
            'master_class_id'=>'required',
            'shift'=>'required',
            'section'=>'required',
            'group_class_id'=>'required',
            'subject_id'=>'required',
      ]);
    }

    protected function duplicateCheck($request){
      $data = $request->except(['_token','staff_id']);
      $data['school_id']=Auth::getSchool();
      return SubjectTeacher::where($data)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $classes = $this->getClasses();
        $units =$this->getUnits();
        $class_groups=$this->groupClasses();
        $teachers=Staff::join('users','staff.user_id', '=', 'users.id')
                        ->where('users.group_id', 3)
                        ->where('staff.school_id', Auth::getSchool())
                        ->select('staff.id','users.name as name','staff.subject as subject')
                        ->get();
        $subjectTeacher = SubjectTeacher::where(['school_id'=>Auth::getSchool(),'id'=>$id])->first();
        return view('backEnd.subjectsTeachers.edit', compact('classes','units','class_groups','teachers','subjectTeacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $this->validationCheck($request);
        $duplicateCheck=$this->duplicateCheck($request);
        if (isset($duplicateCheck->id)&&$duplicateCheck->id!=$id){
          Session::flash('errmgs', 'দুঃখিত, বিষয়টি পূর্বেই এসাইন করা হয়েছে !');
          return redirect()->back();
        }

        $data = $request->except('_token');
        $data['school_id']= Auth::getSchool();

        try{
            SubjectTeacher::where('id',$id)->update($data);
            Session::flash('sccmgs', 'বিষয় সফলভাবে আপডেট করা হয়েছে !');
            return redirect()->back();
        }catch (\Exception $e){
            Session::flash('errmgs', 'দুঃখিত, সমস্যা !'.$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        try{
            SubjectTeacher::where(['id'=>$id, 'school_id'=>Auth::getSchool()])->delete();
            Session::flash('sccmgs', 'বিষয় সফলভাবে মুছে ফেলা হয়েছে !');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }


    public function getClassSubjects(Request $request)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $data = $request->all();
        $data['school_id'] = Auth::getSchool();
        $subjects = Subject::where($data)->get();
        return $subjects;
    }



}
