<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Holiday;
use App\Rules\IdCardNumberCheck;
use App\Custom\Attendance\StudentLeave;
use App\Custom\Attendance\EmployeeLeave;

class LeaveController extends Controller
{
    public $months = Array ('January','February','March','April','May','June','July','August','September','October','November','December');
        public function create(Request $request)
        {
            $months = $this->months;
            $days = array();
            if($request->all()){
                $this->validate($request,[
                    'year'=>'required',
                    'month'=>'required',
                ]);
                $num_of_days = date('t',mktime (0,0,0,$request->month,1,$request->year));
                for( $i=1; $i<= $num_of_days; $i++) {
                   $time=mktime(0, 0, 0, $request->month, $i, $request->year);
                   $days[] = date('l d-m-Y', $time);
                }
            }
            $holidays = Holiday::where('school_id',Auth::getSchool())
                        ->whereMonth('date',$request->month)
                        ->whereYear('date',$request->year)
                        ->select('date')->get();
            $public_holidays = array();
            if($holidays){
               foreach ($holidays as $holiday) {
                   $public_holidays[] = $holiday->date;
               }
            }
            $months = json_encode($months);
            $days = json_encode($days);
            $search = $request->except('_token');
            return view('backEnd.attendence.leave.create',compact('days','months','search','public_holidays'));
        }

        public function store(Request $request,StudentLeave $student_leave,EmployeeLeave $employee_leave)
        {
            $this->validate($request,[
                'id_card_no'=>['required','numeric',new IdCardNumberCheck()],
                'date'=>'required'
            ]);

            $data=$this->request_data_process($request);
            try {
                if($data['lenth']==15){
                   return $student_leave->entry($data);
                }else{
                   return $employee_leave->entry($data);
                }
            } catch (Exception $e) {
                return $this->returnWithError("Wrong, ".$e." !!");
            }
        }

        public function request_data_process($request){
            
            $data['id_card_no']=$request->id_card_no;
            $data['lenth']=strlen($request->id_card_no);
            if($data['lenth']==30){
              $data['id_card_no']=substr($data['id_card_no'], 0,15);
              $lenth=strlen($data['id_card_no']);
            }
            if($data['id_card_no']==24){
              $data['id_card_no']=substr($data['id_card_no'], 0,12);
              $data['lenth']=strlen($id_no);
            }
            if(isset($request->date)){
              $data['date']=$request->date;
            }
            return $data;
        }
}
