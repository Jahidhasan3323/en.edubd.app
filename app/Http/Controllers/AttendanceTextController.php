<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AttendanceText;
use App\School;

class AttendanceTextController extends Controller
{
    public function add(){
		$schools = School::all();
		return view('backEnd.attendance_text.add',compact('schools'));
	}

    public function store(Request $request){
        $duplicate = AttendanceText::where('school_id',$request->school_id)->where('type', $request->type)->first();
        if($duplicate){
            return redirect()->back()->with('errmgs', 'এই প্রতিষ্ঠানের জন্য বার্তাটি পূর্বেই যোগ করা হয়েছে ।') ;
        }
		$this->validate($request,[
			"school_id" => "required",
			"content" => "required",
		]);
		$data = $request->all();
		AttendanceText::create($data);
		return redirect()->route('attendanceText.list')->with('sccmgs', 'বার্তা সফলভাবে যোগ করা হয়েছে ।');
	}

    public function list(Request $request){
		$attendances = AttendanceText::all();
		return view('backEnd.attendance_text.list',compact('attendances'));
	}

    public function edit($id){
		$attendance = AttendanceText::find($id);
		return view('backEnd.attendance_text.edit',compact('attendance'));
	}

	public function update(Request $request,$id){
		$this->validate($request,[
			"school_id" => "required",
			"content" => "required",
		]);
		$data = $request->all();
		AttendanceText::find($id)->update($data);
		return redirect()->route('attendanceText.list')->with('sccmgs', 'বার্তা সফলভাবে আপডেট করা হয়েছে ।');
	}

	public function delete($id){
		$attendance = AttendanceText::find($id)->forceDelete();
		return redirect()->route('attendanceText.list')->with('sccmgs', 'বার্তা সফলভাবে মুছে ফেলা হয়েছে ।');
	}

}
