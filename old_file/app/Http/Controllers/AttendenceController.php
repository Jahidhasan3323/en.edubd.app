<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\IdCardNumberCheck;
use App\Http\Controllers\LeaveController;
use App\Custom\Attendance\StudentAttendance;
use App\Custom\Attendance\EmployeeAttendance;
use Session;
use Carbon\Carbon;
use App\AttenStudent;
use App\MasterClass;
use App\GroupClass;
use App\Unit;
use App\Student;
use App\AttenEmployee;
use App\User;
use App\Staff;
use App\School;
use DB;

class AttendenceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      /*date("z", mktime(0,0,0,date('m'),date('d'),date('Y')))+1;
      date("z", mktime(0,0,0,date('m'),date('d'),date('Y')))+1;
      $date1=date_create("2013-03-15");
      $date2=date_create("2013-12-12");
      $diff=date_diff($date1,$date2);*/
        return view('backEnd.attendence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function storeOrUpdate(Request $request,LeaveController $leave_controller,StudentAttendance $student_attendance,EmployeeAttendance $employee_attendance)
    {
        $this->validate($request,[
            'id_card_no'=>['required','numeric',new IdCardNumberCheck()]
        ]);
        $imp_setting=\App\ImportantSetting::where('school_id',Auth::getSchool())->first();
        if($imp_setting->atten_start_time==NULL||$imp_setting->atten_end_time==NULL||$imp_setting->leave_start_time==NULL||$imp_setting->leave_end_time==NULL){
           Session::flash('errmgs', 'Wrong, Please setting attendance time schedule full-fill, Important settings !');
           return redirect()->back();
        }
        $check_time=strtotime(Carbon::now()->format("h:i:s a"));
        $atten_start_time=strtotime(isset($imp_setting->atten_start_time)?$imp_setting->atten_start_time:'');
        $atten_end_time=strtotime(isset($imp_setting->atten_end_time)?$imp_setting->atten_end_time:'');
        $leave_start_time=strtotime(isset($imp_setting->leave_start_time)?$imp_setting->leave_start_time:'');
        $leave_end_time=strtotime(isset($imp_setting->leave_end_time)?$imp_setting->leave_end_time:'');

        if(($check_time >= $atten_start_time && $check_time <= $atten_end_time)||($check_time >= $leave_start_time && $check_time <= $leave_end_time)){
              $data=$leave_controller->request_data_process($request);
              try{
                  if($data['lenth']==15 || $data['lenth']==30){
                     return $student_attendance->entry($data);
                  }else{
                     return $employee_attendance->entry($data);
                  }
              }catch (Exception $e) {
                  return $this->returnWithError("Wrong, ".$e." !!");
              }
        }else{
          return $this->returnWithError("Invalid Time... !");
        }
    }

    public function students()
    {
        $students=AttenStudent::with('masterClass')
                         ->where('school_id',Auth::getSchool())
                         ->whereDate('date',date('Y-m-d'))
                         ->groupBy(['master_class_id','group','shift','section'])
                         ->selectRaw('*,count(student_id) as total')
                         ->get();
        $current_students=Student::where('school_id',Auth::getSchool())
                         ->current()
                         ->count();
        return view('backEnd.attendence.student.index',compact('students','current_students'));
    }

    public function view($class_id,$group,$shift,$section)
    {
        $attendances=AttenStudent::with('student','student.user')->where([
                            'school_id'=>Auth::getSchool(),
                            'master_class_id'=>$class_id,
                            'group'=>$group,
                            'shift'=>$shift,
                            'section'=>$section,
                            'date'=>date('Y-m-d'),
                           ])->get();
        $class = MasterClass::where('id',$class_id)->select('name')->first();
        return view('backEnd.attendence.student.view',compact('attendances','class','group','shift','section'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $student_id)
    {
        $single_student=Student::with('user')->where(['school_id'=>Auth::getSchool(),'student_id'=>$student_id])->first();
        $from    = Carbon::parse($request->from)
                         ->startOfDay()
                         ->toDateString();
        $to      = Carbon::parse($request->to)
                         ->endOfDay()
                         ->toDateString();

        if($request->from&&$request->to){
          $months=AttenStudent::where([
                          'student_id'=>$student_id,
                          'school_id'=>Auth::getSchool()
                      ])->whereBetween('date',[$from,$to])
          ->select(DB::raw('MONTH(date) month'))
          ->groupBy(DB::raw('MONTH(date)'))
          ->orderBy('id','desc')->get();
        }else{
          $months=AttenStudent::where([
                          'student_id'=>$student_id,
                          'school_id'=>Auth::getSchool()
                      ])
          ->whereYear('date', '=', date('Y'))
          ->select(DB::raw('MONTH(date) month'))
          ->groupBy(DB::raw('MONTH(date)'))
          ->orderBy('id','desc')->get();
        }
        return view('backEnd.attendence.student.details',compact('single_student','months','from','to','request'));
    }

    public function print_view(Request $request)
    {
        $single_student=json_decode($request->single_student);
        $from=$request->from;
        $to=$request->to;
        $months=json_decode($request->months);
        $school=School::where('id',Auth::getSchool())->first();
        return view('backEnd.attendence.student.print_view',compact('single_student','months','from','to','school'));
    }

}
