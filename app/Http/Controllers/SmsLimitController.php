<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\School;
use App\SmsLimit;
use Auth;

class SmsLimitController extends Controller
{
    public function sms_setup(){
		$schools = School::all();
		return view('backEnd.sms.sms_setup',compact('schools'));
	}
    public function search(Request $request){
		$schools = School::all();
		$school_id = $request->school_id;
		$sms_limit = SmsLimit::where('school_id', $school_id)->first();
		return view('backEnd.sms.sms_setup',compact('sms_limit','schools','school_id'));
	}

    public function store(Request $request){
		$this->validate($request, [
			"notification" => "numeric|nullable",
			"result" => "numeric|nullable",
			"due_sms" => "numeric|nullable",
			"fee_collection" => "numeric|nullable",
			"fine_collection" => "numeric|nullable",
			"income" => "numeric|nullable",
			"expense" => "numeric|nullable",
		]);
		$data = $request->all();
		$sms_limit = SmsLimit::where('school_id', $request->school_id)->first();
		$sms_limit?$sms_limit->update($data):SmsLimit::create($data);
		return redirect()->route('smsLimit.sms_setup')->with('success_msg','এস,এম,এস সেটাপ সফল হয়েছে ।');
	}


}
