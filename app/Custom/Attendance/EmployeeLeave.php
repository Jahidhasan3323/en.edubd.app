<?php
 namespace App\Custom\Attendance;
 
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 use Carbon\Carbon;
 use App\AttenEmployee;
 use Auth;

 class EmployeeLeave extends Controller
 {
 		public function entry($data)
 		{  
	          foreach ($data['date'] as $date){
	           $r_data=$this->data_process($data,$date);
	           $attendance = AttenEmployee::where($r_data)->first();
	           if($attendance){
	              $attendance->update(['status'=>'L','in_time'=>NULL,'out_time'=>NULL]);
	           }else{
	              $r_data['status']='L';
	              AttenEmployee::create($r_data);
	           }
	          }
	          return $this->returnWithSuccess("Employee, Leave entry success !!");        
 		}

 		protected function data_process($data,$date){
 	       	$r_data['school_id']=Auth::getSchool();
 	       	$r_data['staff_id']=$data['id_card_no'];
 	       	$r_data['date']=date('Y-m-d',strtotime($date));
 	       	return $r_data;
 	   }
 }