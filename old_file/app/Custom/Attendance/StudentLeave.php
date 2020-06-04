<?php
 namespace App\Custom\Attendance;

 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 use App\Student;
 use App\AttenStudent;
 use Auth;


 class StudentLeave extends Controller
 {
 	public function entry($data)
 	{  
               foreach ($data['date'] as $date){
                $r_data=$this->data_process($data,$date);
                $attendance = AttenStudent::where($r_data)->first();
                if($attendance){
                        $attendance->update(['status'=>'L','in_time'=>NULL, 'out_time'=>NULL]);
                }else{
                        $r_data['status']='L';
                        AttenStudent::create($r_data);
                }
               }
               return $this->returnWithSuccess("Student, Leave entry success !!");        
 	}

 	protected function data_process($data,$date){
            $student=Student::where(['school_id'=>Auth::getSchool(),'student_id'=>$data['id_card_no']])->first();
        	$r_data['school_id']=Auth::getSchool();
        	$r_data['student_id']=$student->student_id;
        	$r_data['master_class_id']=$student->master_class_id;
        	$r_data['shift']=$student->shift;
        	$r_data['section']=$student->section;
        	$r_data['group']=$student->group;
        	$r_data['roll']=$student->roll;
        	$r_data['session']=$student->session;
        	$r_data['regularity']=$student->regularity;
        	$r_data['date']=date('Y-m-d',strtotime($date));
        	return $r_data;
    }
 }