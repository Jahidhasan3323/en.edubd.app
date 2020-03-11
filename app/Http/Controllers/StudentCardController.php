<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\School;
use App\MasterClass;
use App\Student;
use App\Unit;
use \Milon\Barcode\DNS1D;

class StudentCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $school_id=$request->school_id;
        $schools=School::all();
        $school=School::where('id',$request->school_id)->select('school_type_id')->first();
        $school_type_ids=array();
        if(isset($school->school_type_id)){
            $school_type_ids=explode('|', $school->school_type_id);
        }
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $units=$this->getUnits();
        $groups = $this->groupClasses();
        return view('backEnd.idcard.studentCard.index',compact('classes','units','school_id','schools','groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student='';
        $students=array();

        if(isset($request->student_id)&& is_array($request->student_id)){
           $data=$request->except('_token','student_id','issue_date','end_date');
           $students= Student::where($data)->whereIn('student_id',$request->student_id)->get();
        }else{
            if(isset($request->student_id)){
               $student= Student::where(['student_id'=>$request->student_id,'school_id'=>$request->school_id])->current()->first();
            }else{
                if($request->master_class_id=='all'){
                   $students= Student::where(['school_id'=>$request->school_id])->current()->get();
                }else{
                    if(isset($request->section) && isset($request->group)){
                        $students= Student::where(['master_class_id'=>$request->master_class_id,'group'=>$request->group,'section'=>$request->section,'school_id'=>$request->school_id])->current()->get();
                    }else{
                        if(isset($request->section)){
                            $students= Student::where(['master_class_id'=>$request->master_class_id,'section'=>$request->section,'school_id'=>$request->school_id])->current()->get();
                        }else{
                            if(isset($request->group)){
                                $students= Student::where(['master_class_id'=>$request->master_class_id,'group'=>$request->group,'school_id'=>$request->school_id])->current()->get();
                            }else{
                                $students= Student::where(['master_class_id'=>$request->master_class_id,'school_id'=>$request->school_id])->current()->get();
                            }

                        }

                    }
                }
            }
        }


        $school=School::where('id',$request->school_id)->select('school_type_id')->first();
        $school_type_ids=explode('|', $school->school_type_id);

        return view('backEnd.idcard.studentCard.create',compact('student','students','school_type_ids','request'));
    }


    public function student_cart_list_print(Request $request)
    {
        $students=array();
        if(isset($request->student_id)&& is_array($request->student_id)){
           $data=$request->except('_token','student_id','issue_date','end_date');
           $students= Student::where($data)->whereIn('student_id',$request->student_id)->get();
        }else{
          return $this->returnWithError('দয়া করে, কমপক্ষে একজন শিক্ষার্থী নির্বাচন করুন');
        }
        $school=School::with('user')->where('id',$request->school_id)->first();

        return view('backEnd.idcard.studentCard.student_list_print',compact('students','request','school'));
    }



    public function print_lists(Request $request)
    {
          $data=['school_id'=>$request->school_id,
               'master_class_id'=>$request->master_class_id,
               'group'=>$request->group,
               'section'=>$request->section,
               'shift'=>$request->shift,
               'session'=>$request->session,
               'id_card_exits'=>0,
           ];
          $students = Student::with('user','masterClass')
               ->where($data)->orderBy('id', 'desc')
               ->get();
          if(count($students)<1){
            return $this->returnWithError('সকল শিক্ষার্থীর আইডি কার্ড আছে !!');
          }
          $school = School::where('id',$request->school_id)->first();
          $print=1;
          return view('backEnd.students.student_controll.index', compact('students','school','print'));
    }
}
