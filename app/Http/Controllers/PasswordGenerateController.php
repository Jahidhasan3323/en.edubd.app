<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\School;
use App\MasterClass;
use App\Student;
use App\Staff;
use App\Commitee;
use App\User;

class PasswordGenerateController extends Controller
{
    public function student_password(){
		$schools = School::all();
        $class_groups=$this->groupClasses();
        $units=$this->getUnits();
        $sessions = Student::distinct('session')->pluck('session');
		return view('backEnd.password.student_password',compact('schools','class_groups','units','sessions'));
	}
	public function student_password_reset(Request $request){
		// dd($request->all());
		$students = Student::where([
			"school_id" => $request->school_id,
			"master_class_id" => $request->master_class_id,
			"group" => $request->group,
			"shift" => $request->shift,
			"section" => $request->section,
			"session" => $request->session,
		])->get();
		$student = Student::where([
			"school_id" => $request->school_id,
			"master_class_id" => $request->master_class_id,
			"group" => $request->group,
			"shift" => $request->shift,
			"section" => $request->section,
			"session" => $request->session,
		])->first();
        if (empty($student)) {
            return redirect()->route('student_password')->with('errmgs','Student not found !');
        }
        $school = School::find($request->school_id);
		$schools = School::all();
        $class_groups=$this->groupClasses();
        $units=$this->getUnits();
        $sessions = Student::distinct('session')->pluck('session');
		return view('backEnd.password.student_password',compact('schools','class_groups','units','sessions','students','student','request','school'));
	}

	public function student_password_generate(Request $request){
		$school = School::find($request->school_id);
		$user_id = $this->password_reset($request->id);
		$student = Student::whereIn('user_id',$user_id)->first();
		$students = Student::whereIn('user_id',$user_id)->get();
		return view('backEnd.login_info.print.student_login_info_print',compact('school','students','student'));
	}

    public function employee_password(){
		$schools = School::all();
		return view('backEnd.password.employee_password',compact('schools'));
	}
	public function employee_password_reset(Request $request){
		// dd($request->all());
		$schools = School::all();
        $school = School::find($request->school_id);
        $employees = Staff::where('school_id',$request->school_id)->get();
        if (count($employees) < 1) {
            return redirect()->route('employee_password')->with('errmgs','Employee not found !');
        }
		return view('backEnd.password.employee_password',compact('schools','employees','school'));
	}

	public function employee_password_generate(Request $request){
		// dd($request->all());
		$school = School::find($request->school_id);
		$user_id = $this->password_reset($request->id);
		$employees = Staff::whereIn('user_id',$user_id)->get();
		return view('backEnd.login_info.print.employee_login_info_print',compact('school','employees'));
	}

    public function committee_password(){
		$schools = School::all();
		return view('backEnd.password.committee_password',compact('schools'));
	}
	public function committee_password_reset(Request $request){
		$schools = School::all();
        $school = School::find($request->school_id);
        $committees = Commitee::where('school_id',$request->school_id)->get();
        if (count($committees) < 1) {
           return redirect()->route('committee_password')->with('errmgs','Committee not found !');
        }
		return view('backEnd.password.committee_password',compact('schools','committees','school'));
	}

	public function committee_password_generate(Request $request){
		// dd($request->all());
		$school = School::find($request->school_id);
		$user_id = $this->password_reset($request->id);
		$committees = Commitee::whereIn('user_id',$user_id)->get();
		return view('backEnd.login_info.print.committee_login_info_print',compact('school','committees'));
	}

    public function password_reset($user_id)
    {
        $users = User::whereIn('id',$user_id)->get();
        foreach ($users as $user) {
            $password = rand(10000000,99999999);
            $user->real_password = $password;
            $user->password = bcrypt($password);
            // $user->real_password = null;
            $user->save();
        }
        return $user_id;
    }



}
