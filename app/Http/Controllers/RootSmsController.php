<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Custom\AllNumber;
use App\School;
use App\Student;
use App\Staff;
use App\commitee;

class RootSmsController extends Controller
{
	public function add(){
		$schools = School::all();
		return view('backEnd.sms.root_sms',compact('schools'));
	}

	public function msg_count(Request $request,SmsSendController $sms_send){
		if ($request->school_id) {
			$school = School::find($request->school_id);
			$school_name = strlen($school->short_name??$sms_send->school_name_process($school->user->name))+1;
			$char = strlen($request->message)+$school_name+16;
			$msg = ceil(($char)/160);
			$text = $school->short_name?$school->short_name.$request->message:$request->message.$sms_send->school_name_process($school->user->name);
		}else {
			$school_name = "";
			$char = strlen($request->message)+16;
			$msg = ceil(($char)/160);
			$text = $request->message;
		}

		$data = [
			"char_count" => $char,
			"msg_count" => $msg,
			"school_name" => $school_name,
		];
		if(preg_match('/[^\x20-\x7f]/', $text)){
			$data['text_status'] = 'unicode';
		}else {
			$data['text_status'] = 'regular';
		}
		return json_encode($data);
	}

	public function send(Request $request,SmsSendController $sms_send){
		$school = School::find($request->school_id);
		$school_name = $school->short_name??$sms_send->school_name_process($school->user->name);
		$students = Student::where('school_id', $school->id)->current()->get();
		$staffs = Staff::where('school_id', $school->id)->current()->get();
		$committees = commitee::where('school_id', $school->id)->current()->get();
		$content=$request->content.' '.$school_name;
		$message= urlencode($content);
		$numbers = AllNumber::get_numbers($students,$staffs,$committees);
		// $numbers = "8801729890904";
		// dd($numbers);
		$send = $this->sms_send_by_api($school,$numbers,$message);
		return redirect()->route('rootSms.add')->with('sccmgs', $send);
	}

	public function multi_school(){
		$schools = School::all();
		return view('backEnd.sms.root_multi_school_sms',compact('schools'));
	}

	public function multi_school_send(Request $request,SmsSendController $sms_send){
		if ($request->id==null) {
			return redirect()->route('rootSms.multi_school')->with('errmgs', "কমপক্ষে ১ টি প্রতিষ্ঠান নির্বাচন করুন ।");
		}
		$schools = School::whereIn('id', $request->id)->get();
		foreach ($schools as $school) {
			$school_name = $school->short_name??$sms_send->school_name_process($school->user->name);
			$students = Student::where('school_id', $school->id)->current()->get();
			$staffs = Staff::where('school_id', $school->id)->current()->get();
			$committees = commitee::where('school_id', $school->id)->current()->get();
			$content=$request->content.' '.$school_name;
			$message= urlencode($content);
			$numbers = AllNumber::get_numbers($students,$staffs,$committees);
			// $numbers = "8801729890904";
			// dd($numbers);
			$send = $this->sms_send_by_api($school,$numbers,$message);
			$school_count = 0;
			$success = json_decode($send,true);
            if ($success['error']==0) {
                $school_count++;
            }
		}
		return redirect()->route('rootSms.multi_school')->with('sccmgs', 'প্রতিষ্ঠানঃ '.$school_count.' '.$send);
	}


}
