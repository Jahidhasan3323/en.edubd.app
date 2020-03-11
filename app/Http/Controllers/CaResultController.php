<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamType;
use App\MasterClass;
use App\CaResult;
use App\School;
use App\Student;
use App\GroupClass;
use App\CaSubject;
use App\SchoolType;
use App\User;
use function GuzzleHttp\Psr7\copy_to_stream;
use Illuminate\CustomClasses\ResultCalculate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Rules\CaResultEntryCheck;
use Illuminate\Support\Collection;

class CaResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $classes =$this->getClasses();
      $group_classes =$this->groupClasses();
      $units =$this->getUnits();
      $exam_types = ExamType::all();
      return view('backEnd.caResult.index', compact('classes','group_classes','units','exam_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $classes =$this->getClasses();
        $group_classes =$this->groupClasses();
        $units =$this->getUnits();
        $group_class=GroupClass::where('id',$request->group_class_id)->select('name')->first();
        $students=array();
        $subjects=array();
        
        if($request->all()){
            $students= Student::with('user')->where([
                'master_class_id'=>$request->master_class_id,
                'group'=>$group_class->name,
                'section'=>$request->section,
                'shift'=>$request->shift,
                'school_id'=>Auth::getSchool()
            ])->get();
            $students=collect($students)->sortBy('roll');
            $subjects = CaSubject::where([
                'master_class_id'=>$request->master_class_id,
                'group_class_id'=>$request->group_class_id,
                'school_id'=>Auth::getSchool()
            ])->select(['id','subject_name'])->get();
         }

        $exam_types = ExamType::all();
        $search= $request->all();

        return view('backEnd.caResult.create', compact('classes','group_classes','units','students','subjects','exam_types','search'));
    }



    public function get_subject(Request $request){
           $subject = CaSubject::where([
               'master_class_id'=>$request->master_class_id,
               'group_class_id'=>$request->group_class_id,
               'id'=>$request->subject_id,
               'school_id'=>Auth::getSchool()
           ])->first();
           return $subject;
    }

    public function getClassSubjects(Request $request)
    {
        $data = $request->all();
        $data['school_id'] = Auth::getSchool();
        $subjects = CaSubject::where($data)->get();
        return $subjects;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
         $this->create_result_validation($request);
         foreach ($request->student_id as $key => $student_id) {
             $data=$request->except('student_id','roll','marks');
             $data['student_id']=$student_id;
             $data['roll']=$request->roll[$key];
             $data['marks']=$request->marks[$key];
             CaResult::create($data);
         }

         $this->returnWithSuccess('Result entry success. (Subject-'.$request->subject_name.')');
         return redirect()->back();
    }


    protected function create_result_validation($request){
        $this->validate($request,[
          'exam_type_id'=>'required',
          'exam_year'=>'required',
          'subject_id'=>['required',new CaResultEntryCheck($request->only('exam_type_id','exam_year','master_class_id','group_class_id','shift','section'))]
        ]);
    }

    protected function update_result_validation($request){
        $this->validate($request,[
          'exam_type_id'=>'required',
          'exam_year'=>'required',
          'subject_id'=>'required',
          'subject_status'=>'required',
        ]);
    }


 

    
    public function edit(Request $request)
    {
        $this->validation_for_update_searching($request);
        $result_check=$this->editable_result_check($request);
        if(!$result_check){
          return $this->returnWithError('No result found');
        }
        $classes =$this->getClasses();
        $group_classes =$this->groupClasses();
        $units =$this->getUnits();
        $group_class=GroupClass::where('id',$request->group_class_id)->select('name')->first();
        $students=array();
        $subjects=array();
        
        if($request->all()){
            $students= Student::with('user')->where([
                'master_class_id'=>$request->master_class_id,
                'group'=>$group_class->name,
                'section'=>$request->section,
                'shift'=>$request->shift,
                'school_id'=>Auth::getSchool()
            ])->get();
            $students=collect($students)->sortBy('roll');
            $subjects = CaSubject::where([
                'master_class_id'=>$request->master_class_id,
                'group_class_id'=>$request->group_class_id,
                'school_id'=>Auth::getSchool()
            ])->select(['id','subject_name'])->get();
         }

        $exam_types = ExamType::all();
        $search= $request->all();

        return view('backEnd.caResult.edit', compact('classes','group_classes','units','students','subjects','exam_types','search'));

    }


    public function validation_for_update_searching($request)
    {
        $this->validate($request,[
          'exam_year'=>'required',
          'subject_id'=>'required',
          'exam_type_id'=>'required',
          'master_class_id'=>'required',
          'group_class_id'=>'required',
          'shift'=>'required',
          'section'=>'required',
        ]);
    }

    

    public function editable_result_check($request)
    {
        return CaResult::where([
          'school_id'=>Auth::getSchool(),
          'author_by'=>Auth::user()->id,
          'subject_id'=>$request->subject_id,
          'master_class_id'=>$request->master_class_id,
          'group_class_id'=>$request->group_class_id,
          'shift'=>$request->shift,
          'section'=>$request->section,
        ])->first();
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
        //$this->create_result_validation($request);
      foreach ($request->student_id as $key => $student_id) {
        if($request->result_id[$key]!=null){
           $data=$request->except('student_id','roll','marks','_token','result_id');
           $data['student_id']=$student_id;
           $data['roll']=$request->roll[$key];
           $data['marks']=$request->marks[$key];
           $data['gpa']=Auth::calculateResult($request->marks[$key],$request->total_mark)['gpa'];
           $data['grade_latter'] = Auth::grade(Auth::calculateResult($request->marks[$key],$request->total_mark)['gpa']);
           $data['author_by']=Auth::user()->id;
           CaResult::where([
            'id'=>$request->result_id[$key],
            'school_id'=>Auth::getSchool(),
           ])->update($data);
        }else{
           $data=$request->except('student_id','roll','marks');
           $data['student_id']=$student_id;
           $data['roll']=$request->roll[$key];
           $data['marks']=$request->marks[$key];
           CaResult::create($data);
        }
      }
        dd('ok');
        $this->returnWithSuccess('Result update success. (বিষয়-'.$request->subject_name.')');
        return redirect()->back();
    }

   
    public function update_grand_total_mark_procesing($total,$result)
    {
        return ($result->grand_total_mark-$result->sub_total)+$total;
    }

    public function destroy($id)
    {
        //
    }
}
