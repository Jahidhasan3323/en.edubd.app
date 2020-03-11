<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamType;
use App\MasterClass;
use App\Result;
use App\School;
use App\Student;
use App\Subject;
use App\Teacher;
use App\Unit;
use App\GroupClass;
use App\SchoolType;
use App\User;
use function GuzzleHttp\Psr7\copy_to_stream;
use Illuminate\CustomClasses\ResultCalculate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Rules\SingleResultEntryCheck;
use Illuminate\Support\Collection;

class SingleResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $classes =$this->getClasses();
      $group_classes =GroupClass::all();
      $units =$this->getUnits();
      $exam_types = ExamType::all();
      return view('backEnd.singleResults.index', compact('classes','group_classes','units','exam_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $classes =$this->getClasses();
        $group_classes =GroupClass::all();
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
            ])->current()->get();
            $students=collect($students)->sortBy('roll');
            $subjects = Subject::where([
                'master_class_id'=>$request->master_class_id,
                'group_class_id'=>$request->group_class_id,
                'school_id'=>Auth::getSchool()
            ])->select(['id','subject_name'])->get();
         }

        $exam_types = ExamType::all();
        $search= $request->all();

        return view('backEnd.singleResults.create', compact('classes','group_classes','units','students','subjects','exam_types','search'));
    }



    public function get_subject(Request $request){
           $subject = Subject::where([
               'master_class_id'=>$request->master_class_id,
               'group_class_id'=>$request->group_class_id,
               'id'=>$request->subject_id,
               'school_id'=>Auth::getSchool()
           ])->first();
           return $subject;
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
         foreach ($request->roll as $key => $roll) {
            if(isset($request->student_id[$roll])){
               $grand_total_mark=$this->grand_total_mark_procesing($request,$key);
               $check_mark = $this->check_mark_proccess($request,$key);
               $total=$this->per_subjet_sub_total_mark($check_mark);
               $data=$this->data_proccess($request,$key,$total,$grand_total_mark);
               Result::create($data);
               $this->grand_total_mark_update($request,$key,$data);
            }
         }
         $this->returnWithSuccess('Result entry success. (Subject-'.$request->subject_name.')');
         return redirect()->back();
    }


    protected function grand_total_mark_procesing($request,$key){
        $query=$request->only(['exam_type_id','exam_year','master_class_id','group_class_id','shift','section']);
        $query['student_id']=$request->student_id[$request->roll[$key]];
        $query['roll']=$request->roll[$key];
        $query['school_id']=Auth::getSchool();
        $previus_grand_total_mark=Result::where($query)->select('grand_total_mark')->first();
        $ca_marks=($request->ca_mark[$key]=='--'?0:$request->ca_mark[$key]);
        $cr_marks=($request->cr_mark[$key]=='--'?0:$request->cr_mark[$key]);
        $mcq_marks=($request->mcq_mark[$key]=='--'?0:$request->mcq_mark[$key]);
        $pr_marks=($request->pr_mark[$key]=='--'?0:$request->pr_mark[$key]);
        if($ca_marks==0){
          $grand_total_mark=$ca_marks+$cr_marks+$mcq_marks+$pr_marks;
        }else{
          $grand_total_mark=$ca_marks+((($cr_marks+$mcq_marks+$pr_marks)*80)/100);
        }
        if($previus_grand_total_mark){
          return ($grand_total_mark+$previus_grand_total_mark->grand_total_mark);
        }
        return $grand_total_mark;
    }

    protected function grand_total_mark_update($request,$key,$data){
        $query=$request->only(['exam_type_id','exam_year','master_class_id','group_class_id','shift','section']);
        $query['student_id']=$request->student_id[$request->roll[$key]];
        $query['roll']=$request->roll[$key];
        $query['school_id']=Auth::getSchool();
        Result::where($query)->update(['grand_total_mark'=>$data['grand_total_mark']]);
    }
    
    protected function check_mark_proccess($request,$key){
       $check_mark['ca_mark']=($request->ca_mark[$key]=='--'?0:$request->ca_mark[$key]);
       $check_mark['cr_mark']=($request->cr_mark[$key]=='--'?0:$request->cr_mark[$key]);
       $check_mark['mcq_mark']=($request->mcq_mark[$key]=='--'?0:$request->mcq_mark[$key]);
       $check_mark['pr_mark']=($request->pr_mark[$key]=='--'?0:$request->pr_mark[$key]);
       return $check_mark; 
    }


    protected function per_subjet_sub_total_mark($check_mark){
       $total_without_ca_mark=$check_mark['cr_mark']+$check_mark['mcq_mark']+$check_mark['pr_mark'];
       if($check_mark['ca_mark']==0){
          $total=$total_without_ca_mark;
       }else{
          $total=$check_mark['ca_mark']+(($total_without_ca_mark*80)/100);
       }
        return $total;
    }

    protected function data_proccess($request,$key,$total,$grand_total_mark){
       return [
         "exam_type_id" => $request->exam_type_id,
         "exam_year" => $request->exam_year,
         "student_id" => $request->student_id[$request->roll[$key]],
         "regularity" => $request->regularity[$key],
         "roll" => $request->roll[$key],
         "master_class_id" => $request->master_class_id,
         "group_class_id" => $request->group_class_id,
         "shift" => $request->shift,
         "section" => $request->section,
         "subject_id" => $request->subject_id,
         "subject_name" => $request->subject_name,
         "ca_mark" => $request->ca_mark[$key],
         "cr_mark" => $request->cr_mark[$key],
         "mcq_mark" => $request->mcq_mark[$key],
         "pr_mark" => $request->pr_mark[$key],
         "sub_total" => "$total",
         "ca_pass_mark" => $request->ca_pass_mark==null?0:$request->ca_pass_mark,
         "cr_pass_mark" => $request->cr_pass_mark==null?0:$request->cr_pass_mark,
         "mcq_pass_mark" => $request->mcq_pass_mark==null?0:$request->mcq_pass_mark,
         "pr_pass_mark" => $request->pr_pass_mark==null?0:$request->pr_pass_mark,
         "total_pass_mark" => $request->total_pass_mark,
         "total_mark" => $request->total_mark,
         "subject_type" => $request->subject_type,
         "subject_status"=> $request->subject_status,
         "grand_total_mark"=> $grand_total_mark,
      ];
    }

    protected function create_result_validation($request){
        $this->validate($request,[
          'exam_type_id'=>'required',
          'exam_year'=>'required',
          'subject_id'=>['required',new SingleResultEntryCheck($request->only('exam_type_id','exam_year','master_class_id','group_class_id','shift','section'))],
          'subject_status'=>'required',
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
        $group_classes =GroupClass::all();
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
            ])->current()->get();
            $students=collect($students)->sortBy('roll');
            $subjects = Subject::where([
                'master_class_id'=>$request->master_class_id,
                'group_class_id'=>$request->group_class_id,
                'school_id'=>Auth::getSchool()
            ])->select(['id','subject_name'])->get();
         }

        $exam_types = ExamType::all();
        $search= $request->all();
        return view('backEnd.singleResults.edit', compact('classes','group_classes','units','students','subjects','exam_types','search'));
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
          'subject_status'=>'required',
        ]);
    }

    public function getClassSubjects(Request $request)
    {
        $data = $request->all();
        $data['school_id'] = Auth::getSchool();
        $subjects = Subject::where($data)->get();
        return $subjects;
    }

    public function editable_result_check($request)
    {
        return Result::where([
          'school_id'=>Auth::getSchool(),
          //'author_by'=>Auth::user()->id,
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
      $this->update_result_validation($request);

        foreach ($request->roll as $key => $roll) {
           if(isset($request->student_id[$roll])&&$request->result_id[$key]!=null){
                $result=Result::where([
                  'school_id'=>Auth::getSchool(),
                  'id'=>$request->result_id[$key],
                ])->first();
                $check_mark = $this->check_mark_proccess($request,$key);
                $total=$this->per_subjet_sub_total_mark($check_mark);
                $grand_total_mark=$this->update_grand_total_mark_procesing($total,$result);
                $data=$this->data_proccess($request,$key,$total,$grand_total_mark);
                $data['author_by']=Auth::user()->id;
                $result->update($data);
                $this->grand_total_mark_update($request,$key,$data);
            }

           if(isset($request->student_id[$roll])&&$request->result_id[$key]==null){
               $grand_total_mark=$this->grand_total_mark_procesing($request,$key);
               $check_mark = $this->check_mark_proccess($request,$key);
               $total=$this->per_subjet_sub_total_mark($check_mark);
               $data=$this->data_proccess($request,$key,$total,$grand_total_mark);
               Result::create($data);
               $this->grand_total_mark_update($request,$key,$data);
           }

           if(!isset($request->student_id[$roll])&&$request->result_id[$key]!=null){
               $result=Result::where([
                  'school_id'=>Auth::getSchool(),
                  'id'=>$request->result_id[$key],
                ])->first();
               $grand_total_mark=($result->grand_total_mark - $result->sub_total);
               $query=$request->only(['exam_type_id','exam_year','master_class_id','group_class_id','shift','section']);
               $query['student_id']=$result->student_id;
               $query['roll']=$request->roll[$key];
               $query['school_id']=Auth::getSchool();
               Result::where($query)->update(['grand_total_mark'=>$grand_total_mark]);
               $result->forceDelete();
           }
           
        }

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
