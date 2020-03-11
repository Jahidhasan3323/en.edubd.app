<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AttendanceTime;
use App\School;

class AttendanceTimeController extends Controller
{
	public function add(){
		$time = AttendanceTime::select('school_id')->get();
		$schools = School::whereNotIn('id', $time)->get();
		return view('backEnd.attendance_time.add',compact('schools'));
	}

    public function store(Request $request){
		$this->validate($request,[
			"school_id" => "required",
			"in_time" => "required",
			"out_time" => "required",
		]);
		$data = $request->all();
		AttendanceTime::create($data);
		return redirect()->route('attendanceTime.list')->with('sccmgs', 'উপস্থিতি সময় সফলভাবে যোগ করা হয়েছে ।');
	}

    public function list(Request $request){
		$times = AttendanceTime::all();
		return view('backEnd.attendance_time.list',compact('times'));
	}

    public function edit($id){
		$attendance = AttendanceTime::find($id);
		return view('backEnd.attendance_time.edit',compact('attendance'));
	}

	public function update(Request $request,$id){
		$this->validate($request,[
			"school_id" => "required",
			"in_time" => "required",
			"out_time" => "required",
		]);
		$data = $request->all();
		AttendanceTime::find($id)->update($data);
		return redirect()->route('attendanceTime.list')->with('sccmgs', 'উপস্থিতি সময় সফলভাবে আপডেট করা হয়েছে ।');
	}

	public function delete($id){
		$attendance = AttendanceTime::find($id)->forceDelete();
		return redirect()->route('attendanceTime.list')->with('sccmgs', 'উপস্থিতি সময় সফলভাবে মুছে ফেলা হয়েছে ।');
	}


}
