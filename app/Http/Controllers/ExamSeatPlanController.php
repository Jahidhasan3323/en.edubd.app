<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Student;
use App\GroupClass;
use App\School;
use App\ExamType;

class ExamSeatPlanController extends Controller
{
    /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $exams = $this->getExams();
            $years = $this->exam_year();
            $classes = $this->getClasses();
            $groups = $this->groupClasses();
            $units = $this->getUnits();
            return view('backEnd.examSeatPlan.create',compact('classes', 'years', 'exams','groups','units'));
        }

        /**
         * Display the specified resource.
         *
         * @param  show search student exam seat plan show for print
         * @return \Illuminate\Http\Response
         */
        public function show(Request $request)
        {
            $this->validation($request);

            $group=GroupClass::where('id',$request->group_class_id)->first();
            $data=$request->only('master_class_id','shift','section');
            $data['group']=$group->name;
            $data['school_id']=Auth::getSchool();
            if($request->student_id){
               $student_id=explode(',',$request->student_id);
              $students=Student::with('user')->where($data)->whereIn('student_id',$student_id)->current()->get();
           }else{
               $students=Student::with('user')->where($data)->current()->get();
           }
           $exam=ExamType::where('id',$request->exam_type_id)->first();
           $school=School::with('user')->where('id',$data['school_id'])->first();
           return view('backEnd.examSeatPlan.exam_seat_plan',compact('students','school','request','exam'));
       }

       protected function validation($request){
         $this->validate($request,[
            'exam_year'=>'required',
            'exam_type_id'=>'required',
            'master_class_id'=>'required',
            'group_class_id'=>'required',
            'shift'=>'required',
            'section'=>'required'
         ]);
       }
}
