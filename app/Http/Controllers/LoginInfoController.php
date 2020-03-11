<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SmsSendController;
use App\School;
use App\MasterClass;
use App\Student;
use App\Staff;
use App\Commitee;

class LoginInfoController extends Controller
{
    public function student(){
		$schools = School::all();
        $class_groups=$this->groupClasses();
        $units=$this->getUnits();
		return view('backEnd.login_info.student',compact('schools','class_groups','units'));
	}
	public function get_classes(Request $request){
		$type = School::find($request->school_id)->school_type_id;
		$school_type_ids=explode('|', $type);
        return MasterClass::whereIn('school_type_id', $school_type_ids)->get();
	}
	public function st_search(Request $request){
		// dd($request->all());
		$students = Student::where([
			"school_id" => $request->school_id,
			"master_class_id" => $request->master_class_id,
			"group" => $request->group,
			"shift" => $request->shift,
			"section" => $request->section,
		])->current()->get();
		$schools = School::all();
		$classes = $this->getClasses();
        $class_groups=$this->groupClasses();
        $units=$this->getUnits();
		return view('backEnd.login_info.student',compact('schools','classes','class_groups','units','students','request'));
	}

	public function st_sms(Request $request,SmsSendController $sms_send){
		$school = School::find($request->school_id);
		$students = Student::whereIn('id', $request->id)->get();
        $count = 0;
		foreach ($students as $student) {
			$new_email = $student->student_id.'@gmail.com';
			$new_pass = rand(10, 999999999);
			$user = $student->user;
			$user->email = $new_email;
			$user->password = bcrypt($new_pass);
			$user->save();

			$school_name = $school->short_name??$sms_send->school_name_process($school->user->name);
			$content='প্রিয় '.$user->name.' তোমার সফটওয়্যার লগইন তথ্য ! ওয়েব এড্রেস : '.$school->website.', ইমেইল : '.$new_email.', পাসওয়ার্ড : '.$new_pass.'. '.$school_name;
			$message= urlencode($content);
            // dd(urldecode($message));
			$a = $this->sms_send_by_api($school,$user->mobile,$message);
            $success = json_decode($a,true);
            if ($success['error']==0) {
                $count++;
            }
		}
        return redirect()->route('loginInfo.student')->with('sccmgs', $count.' জন শিক্ষার্থীকে লগইন তথ্য পাঠানো হয়েছে ।');
	}

    // Employee Login Infoormation (SMS)
    public function employee(){
		$schools = School::all();
		return view('backEnd.login_info.employee',compact('schools'));
	}

    public function em_search(Request $request){
		// dd($request->all());
		$employees = Staff::where([
			"school_id" => $request->school_id,
		])->current()->get();
		$schools = School::all();
		return view('backEnd.login_info.employee',compact('schools','employees'));
	}

	public function em_sms(Request $request,SmsSendController $sms_send){
		$school = School::find($request->school_id);
		$employees = Staff::whereIn('id', $request->id)->get();
        $count = 0;
		foreach ($employees as $employee) {
			$new_email = $employee->staff_id.'@gmail.com';
			$new_pass = rand(10, 999999999);
			$user = $employee->user;
			$user->email = $new_email;
			$user->password = bcrypt($new_pass);
			$user->save();

			$school_name = $school->short_name??$sms_send->school_name_process($school->user->name);
			$content='প্রিয় '.$user->name.' আপনার সফটওয়্যার লগইন তথ্য ! ওয়েব এড্রেস : '.$school->website.', ইমেইল : '.$new_email.', পাসওয়ার্ড : '.$new_pass.'. '.$school_name;
			$message= urlencode($content);
			$a = $this->sms_send_by_api($school,$user->mobile,$message);
            $success = json_decode($a,true);
            if ($success['error']==0) {
                $count++;
            }
		}
        return redirect()->route('loginInfo.employee')->with('sccmgs', $count.' জন শিক্ষক ও কর্মচারীকে লগইন তথ্য পাঠানো হয়েছে ।');
	}

    // Committee Login Infoormation (SMS)
    public function committee(){
		$schools = School::all();
		return view('backEnd.login_info.committee',compact('schools'));
	}

    public function comm_search(Request $request){
		// dd($request->all());
        $committees = Commitee::where([
			"school_id" => $request->school_id,
		])->current()->get();
		$schools = School::all();
		return view('backEnd.login_info.committee',compact('schools','committees'));
	}

	public function comm_sms(Request $request,SmsSendController $sms_send){
		$school = School::find($request->school_id);
		$committees = Commitee::whereIn('id', $request->id)->get();
        $count = 0;
		foreach ($committees as $committee) {
			$new_email = rand(4, 999999999).'@gmail.com';
			$new_pass = rand(10, 999999999);
			$user = $committee->user;
			$user->email = $new_email;
			$user->password = bcrypt($new_pass);
			$user->save();

			$school_name = $school->short_name??$sms_send->school_name_process($school->user->name);
			$content='প্রিয় '.$user->name.' আপনার সফটওয়্যার লগইন তথ্য ! ওয়েব এড্রেস : '.$school->website.', ইমেইল : '.$new_email.', পাসওয়ার্ড : '.$new_pass.'. '.$school_name;
			$message= urlencode($content);
			$a = $this->sms_send_by_api($school,$user->mobile,$message);
            $success = json_decode($a,true);
            if ($success['error']==0) {
                $count++;
            }
		}
        return redirect()->route('loginInfo.employee')->with('sccmgs', $count.' জন কমিটিকেে লগইন তথ্য পাঠানো হয়েছে ।');
	}



}
