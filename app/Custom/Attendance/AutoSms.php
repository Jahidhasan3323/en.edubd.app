<?php
 namespace App\Custom\Attendance;

 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 use App\Http\Controllers\SmsSendController;
 use App\School;
 use App\Student;
 use App\Staff;
 use App\AttenStudent;
 use App\AttenEmployee;
 use App\Holiday;
 use App\AttendanceText;
 use App\Custom\Sms;
 use Auth;


 class AutoSms extends Controller
 {
 	public static function attend($schools,$person)
 	{
        foreach ($schools as $school) {
            $holiday = Holiday::whereIn('school_id',[$school->id,0])->whereDate('date',date('Y-m-d'))->first();
            $total_students = Student::where('school_id',$school->id)->current()->count();
            $total_employees = Staff::where('school_id',$school->id)->current()->count();
            // School Holiday Check
            if (empty($holiday)) {
                $school_name=$school->short_name?? self::school_name_process($school->user->name);
                $percentage = $school->attend_percentage_limit??'10';
                $numbers = [];
                if ($person==2) {
                    $msg = AttendanceText::where('school_id', $school->id)->where('type',1)->where('person_type',2)->first();
                    $message = urlencode($msg?$msg->content.$school_name:'আপনার সন্তান উপস্থিত হয়েছে ।'.$school_name);
                    // check which user send sms as student or employee
                    if($school->attendance_sms==2 || $school->attendance_sms==3){
                        $attend_students = AttenStudent::where('school_id',$school->id)->whereDate('date', date('Y-m-d'))->where('status','P')->where('in_time','!=',NULL)->get();
                        // Check for attend must be greater than 10%
                        if (($total_students*$percentage)/100 < count($attend_students)){
                            foreach ($attend_students as $attend_student) {
                                if(self::get_st_numbers($attend_student->student_id)){
                                    $numbers[] = self::get_st_numbers($attend_student->student_id);
                                }
                            }
                        }

                    }
                }

                if ($person==1) {
                    $msg = AttendanceText::where('school_id', $school->id)->where('type',1)->where('person_type',1)->first();
                    $message = urlencode($msg?$msg->content.$school_name:'আপনার উপস্থিতি নিশ্চিত হয়েছে '.$school_name);
                    // check which user send sms as student or employee
                    if($school->attendance_sms==1 || $school->attendance_sms==3){
                        $atten_employees = AttenEmployee::with('staff.user')->where('school_id',$school->id)->whereDate('date', date('Y-m-d'))->where('status','P')->where('in_time','!=',NULL)->get();
                        // Check for attend must be greater than 10%
                        if (($total_employees*10)/100 < count($atten_employees)){
                            foreach ($atten_employees as $atten_employee) {
                                if($atten_employee->staff){
                                    if ($atten_employee->staff->user->mobile) {$numbers[] = $atten_employee->staff->user->mobile; }
                                }
                            }
                        }

                    }
                }

                // dd(count($attend_students));
                $chunks = array_chunk($numbers,100);
                foreach ($chunks as $chunk) {
                    $mobile_number = implode(',',$chunk);
                    // $mobile_number = '8801729890904';
                    $url = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
        			Sms::send($url);
                }
            }

        }
 	}

 	public static function absent($schools,$person)
 	{
        foreach ($schools as $school) {
            $holiday = Holiday::whereIn('school_id',[$school->id,0])->whereDate('date',date('Y-m-d'))->first();
            $total_students = Student::where('school_id',$school->id)->current()->count();
            $total_employees = Staff::where('school_id',$school->id)->current()->count();
            if (empty($holiday)) {
                $school_name=$school->short_name?? self::school_name_process($school->user->name);
                $percentage = $school->attend_percentage_limit??'0';
                $numbers = [];
                if ($person==2) {
                    $msg = AttendanceText::where('school_id', $school->id)->where('type', 2)->where('person_type',2)->first();
                    $message =urlencode($msg?$msg->content.$school_name:'আপনার সন্তান অনুপস্থিত '.$school_name);
                    // check which user send sms as student or employee
                    if($school->attendance_sms==2 || $school->attendance_sms==3){
                        $attend_students = AttenStudent::where('school_id',$school->id)->whereDate('date', date('Y-m-d'))->where('status','P')->where('in_time','!=',NULL)->pluck('student_id');
                        $absent_students = Student::where('school_id',$school->id)->whereNotIn('student_id', $attend_students)->current()->get();
                        // Check for attend must be greater than 10%
                        if (($total_students*$percentage)/100 < count($attend_students)){
                            foreach ($absent_students as $absent_student) {
                                if(self::get_st_numbers($absent_student->student_id)){
                                    $numbers[] = self::get_st_numbers($absent_student->student_id);
                                }
                            }
                        }
                    }
                }

                if ($person==1) {
                    $msg = AttendanceText::where('school_id', $school->id)->where('type', 2)->where('person_type',1)->first();
                    $message =urlencode($msg?$msg->content.$school_name:'আপনার অনুপস্থিত যোগ হয়েছে। '.$school_name);
                    // check which user send sms as student or employee
                    if($school->attendance_sms==1 || $school->attendance_sms==3){
                        $attend_employees = AttenEmployee::where('school_id',$school->id)->whereDate('date', date('Y-m-d'))->where('status','P')->pluck('staff_id');
                        $absent_employees = Staff::with('user')->where('school_id',$school->id)->whereNotIn('staff_id',$attend_employees)->current()->get();
                        // Check for attend must be greater than 10%
                        if (($total_employees*10)/100 < count($attend_employees)){
                            foreach ($absent_employees as $absent_employee) {
                                if($absent_employee->user){
                                    if ($absent_employee->user->mobile) {$numbers[] = $absent_employee->user->mobile; }
                                }
                            }
                        }

                    }
                }

                // dd(count($numbers));
                $chunks = array_chunk($numbers,100);
                foreach ($chunks as $chunk) {
                    $mobile_number = implode(',',$chunk);
                    // $mobile_number = '8801729890904';
                    $url = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
        			Sms::send($url);
                }
            }

     	}
    }

 	public static function attend_out($schools,$person)
 	{
        foreach ($schools as $school) {
            $holiday = Holiday::whereIn('school_id',[$school->id,0])->whereDate('date',date('Y-m-d'))->first();
            $total_students = Student::where('school_id',$school->id)->current()->count();
            $total_employees = Staff::where('school_id',$school->id)->current()->count();
            if (empty($holiday)) {
                $school_name=$school->short_name?? self::school_name_process($school->user->name);
                $percentage = $school->attend_percentage_limit??'0';
                $numbers = [];
                if ($person==2) {
                    $msg = AttendanceText::where('school_id', $school->id)->where('type', 3)->where('person_type',2)->first();
                    $message =urlencode($msg?$msg->content.$school_name:'আপনার সন্তান প্রতিষ্ঠান ত্যাগ করেছে '.$school_name);
                    // check which user send sms as student or employee
                    if($school->attendance_sms==2 || $school->attendance_sms==3){
                        $attend_out_students = AttenStudent::where('school_id',$school->id)->whereDate('date', date('Y-m-d'))->where('status','P')->where('out_time','!=',NULL)->get();
                        // Check for attend must be greater than 10%
                        if (($total_students*$percentage)/100 < count($attend_out_students)) {
                            foreach ($attend_out_students as $attend_out_student) {
                                if(self::get_st_numbers($attend_out_student->student_id)){
                                    $numbers[] = self::get_st_numbers($attend_out_student->student_id);
                                }
                            }
                        }

                    }
                }

                if ($person==1) {
                    $msg = AttendanceText::where('school_id', $school->id)->where('type', 3)->where('person_type',1)->first();
                    $message =urlencode($msg?$msg->content.$school_name:'প্রতিষ্ঠান ত্যাগ নিশ্চিত হয়েছে '.$school_name);
                    // check which user send sms as student or employee
                    if($school->attendance_sms==1 || $school->attendance_sms==3){
                        $attend_out_employees = AttenEmployee::with('staff.user')->where('school_id',$school->id)->whereDate('date', date('Y-m-d'))->where('status','P')->where('out_time','!=',NULL)->get();
                        // Check for attend must be greater than 10%
                        if (($total_employees*10)/100 < count($attend_out_employees)) {
                            foreach ($attend_out_employees as $attend_out_employee) {
                                if($attend_out_employee->staff){
                                    if ($attend_out_employee->staff->user->mobile) {$numbers[] = $attend_out_employee->staff->user->mobile; }
                                }
                            }
                        }

                    }
                }


                // dd($numbers);
                $chunks = array_chunk($numbers,100);
                foreach ($chunks as $chunk) {
                    $mobile_number = implode(',',$chunk);
                    // $mobile_number = '8801729890904';
                    $url = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
        			Sms::send($url);
                }
            }

        }
 	}

    public static function get_st_numbers($student_id){
        $student = Student::where('student_id', $student_id)->first();
        if ($student) {
            if ($student->f_mobile_no) {
                return $student->f_mobile_no;
            }elseif ($student->m_mobile_no) {
                return $student->m_mobile_no;
            }elseif($student->user->mobile) {
                return $student->user->mobile;
            }elseif($student->guardian_mobile){
                return $student->guardian_mobile;
            }
        }
    }

    public static function school_name_process($name){
        $school_words=explode(' ',$name);
        foreach ($school_words as $key => $school_word) {
             $school_name_arr[$key]=substr($school_word, 0,6).':';
        }
        return implode(' ', $school_name_arr);
    }


 }
