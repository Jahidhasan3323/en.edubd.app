<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\GroupClass;
use App\Student;
use App\ExamType;
use App\School;
use App\Staff;

class AttendanceListController extends Controller
{
    public $months = Array ('January','February','March','April','May','June','July','August','September','October','November','December');
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validation($request);
        $group=GroupClass::where('id',$request->group_class_id)->first();
        $data=$request->only('master_class_id','shift','section');
        $data['group']=$group->name;
        $data['school_id']=Auth::getSchool();
        $exam_year=$request->exam_year;
        $students=Student::with('user','masterClass')->where($data)->current()->get();
        $students=$students->sortBy('roll');
        $exam=ExamType::where('id',$request->exam_type_id)->first();
        $school=School::with('user')->where('id',$data['school_id'])->first();
        return view('backEnd.attendanceList.daily.index',compact('students','school','request','exam','data','exam_year'));
    }


    protected function validation($request){
      $this->validate($request,[
         'exam_year'=>'required',
         'master_class_id'=>'required',
         'group_class_id'=>'required',
         'shift'=>'required',
         'section'=>'required'
      ]);
    }

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
        return view('backEnd.attendanceList.daily.create',compact('classes', 'years', 'exams','groups','units'));
    }


    public function create_monthly()
    {
        $months = $this->months;
        $groups = $this->groupClasses();
        $classes = $this->getClasses();
        $units = $this->getUnits();
        $months = json_encode($months);
        $years = [date('Y'),date('Y')+1];
        return view('backEnd.attendanceList.monthly.create',compact('years','months','groups','classes','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $query['school_id']=Auth::getSchool();
        $students='';
        $employees='';
        if($request->all()){
            if($request->user_type=="student"){
               $this->validate($request,[
                   'year'=>'required',
                   'month'=>'required',
                   'user_type'=>'required',
                   'master_class_id'=>'required',
                   'group_class_id'=>'required',
                   'shift'=>'required',
                   'section'=>'required',
               ]);
               
                $query=$request->except('user_type','_token','month','year','group_class_id');
                $query['group']=GroupClass::where('id',$request->group_class_id)->value('name');
                $query['school_id']=Auth::getSchool();
                $result=Student::where($query)->current()
                                ->orderBy('roll', 'asc')
                                ->get();
                        $students = collect($result)->sortBy('roll');
            }else{
                $this->validate($request,[
                    'year'=>'required',
                    'month'=>'required',
                    'user_type'=>'required',
                    'master_class_id'=>'nullable',
                    'group_class_id'=>'nullable',
                    'shift'=>'nullable',
                    'section'=>'nullable',
                ]);
                $query['school_id']=Auth::getSchool();
                $employees=Staff::with('user')->where($query)->current()
                             ->get();

                             
            }
            $num_of_days = date('t',mktime (0,0,0,$request->month,1,$request->year));
            for ($i=1; $i <=$num_of_days ; $i++) { 
                $days[]=$request->year.'-'.$request->month.'-'.(strlen($i)==1?'0'.$i:$i);
            }
            $search=$request->only('month','year');
            return view('backEnd.attendanceList.monthly.index',compact('students','employees','days','search'));
        }
    }

    
}
