<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\School;

class AttendanceOptionController extends Controller
{
    public function list(){
		$attendance_options = School::all();
		return view('backEnd.attendance_option.list',compact('attendance_options'));
	}
    public function store(Request $request){
		$this->validate($request,[
			"school_id" => "required",
			"attendance_option" => "required",
		]);
		$attendance_option = School::find($request->school_id);
		$attendance_option->attendance_option = $request->attendance_option;
		$attendance_option->save();
		return redirect()->route('attendanceOption.list')->with('sccmgs','অটোমেটিক উপস্থিতি অপশন সফলভাবে আপডেট হয়েছে ।');
	}

}
