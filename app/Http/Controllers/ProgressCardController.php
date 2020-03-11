<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ResultListController;
use App\Result;
use App\School;
use App\ExamType;
use App\Student;
use App\GroupClass;

class ProgressCardController extends Controller
{

    public function create()
    {
        if (!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student') && !Auth::is('commitee') && !Auth::is('staff')){
            return redirect('/home');
        }
        $exams = $this->getExams();
        $years = $this->exam_year();
        $classes = $this->getClasses();
        return view('backEnd.results.progress_create', compact('classes','years','exams'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cart_show(Request $request, ResultListController $resultList)
    {
        $this->validate($request, [
            'exam_year' => 'required',
            'exam_type_id' => 'required',
            'student_id' => 'required|min:15|max:15',
        ]);
        $student=Student::with(['user','masterClass'])->where([
          'student_id'=>$request->student_id,
          'school_id'=> Auth::getSchool()
        ])->first();

        $results=Result::with(['master_class','group_class'])->where([
            'exam_year'=>$request->exam_year,
            'exam_type_id'=>$request->exam_type_id,
            'student_id'=>$request->student_id,
            'status'=>1,
            'school_id'=> Auth::getSchool()
        ])->get();

        if(count($results)<1){
          Session::flash('errmgs', 'দুঃখিত, ফলাফল এখনো প্রকাশিত হয়নি ।');
          return redirect()->back();
        }

        $res=Result::with(['master_class','group_class'])->where([
            'exam_year'=>$request->exam_year,
            'exam_type_id'=>$request->exam_type_id,
            'master_class_id'=>$student->master_class_id,
            'group_class_id'=>GroupClass::where(['name'=>$student->group])->first()->id,
            'section'=>$student->section,
            'shift'=>$student->shift,
            'status'=>1,
            'school_id'=> Auth::getSchool()
        ])->get();
        $res = collect($res)->sortBy('roll');
        $class_position_numbers=[];
        if(count($res)>0){
          $class_position_numbers=$resultList->class_position_identify_number($request,$res);
        }

        $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
        if($results->count()){
            $exam = ExamType::where('id',$request->exam_type_id)->first();
            return view('backEnd.results.progress_card_view', compact('results','exam','request','school','student','class_position_numbers'));
        }

        Session::flash('errmgs', 'দুঃখিত, কোনো ফলাফল খুজে পাওয়া যায়নি !');
        return redirect()->back();
    }


   public function class_card_create()
   {
       if (!Auth::is('admin') && !Auth::is('teacher')){
           return redirect('/home');
       }
       $exams = $this->getExams();
       $years = $this->exam_year();
       $classes = $this->getClasses();
       $groups = $this->groupClasses();
       $units = $this->getUnits();

       return view('backEnd.results.class_progress_create', compact('classes', 'years', 'exams','groups','units'));
   }


    public function get_class_progress_card(Request $request, ResultListController $resultList)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $data=$this->validate($request,[
            'exam_year' => 'required',
            'exam_type_id' => 'required',
            'master_class_id' => 'required',
            'group_class_id' => 'required',
            'shift' => 'required',
            'section' => 'required'
        ]);

        $data['status'] = 1;
        $data['school_id'] = Auth::getSchool();
        $results = Result::where($data)->get();
        $res = collect($results)->sortBy('roll');
        $class_position_numbers=[];
        if(count($res)>0){
          $class_position_numbers=$resultList->class_position_identify_number($request,$res);
        }
        $all_results = collect($res)->groupBy(['student_id']);
        if ($all_results->count()){
            $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
            $exam = ExamType::where('id',$request->exam_type_id)->first();
            return view('backEnd.results.class_pro_card_view', compact('all_results','exam','request','school','class_position_numbers'));
        }
        Session::flash('errmgs', 'দুঃখিত, কোনো ফলাফল খুজে পাওয়া যায়নি !');
        return redirect()->back();
    }


}
