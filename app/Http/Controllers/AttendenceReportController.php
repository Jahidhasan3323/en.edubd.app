<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\AttenStudent;
use App\MasterClass;
use App\GroupClass;
use App\Unit;
use App\Student;
use App\AttenEmployee;
use App\User;
use App\Staff;
use App\School;
use DB;

class AttendenceReportController extends Controller
{
   public function student_report(){
   	$class=Student::with('masterClass')->where('school_id',Auth::getSchool())
   						->groupBy(['master_class_id'])
   						->get();
   	return view('backEnd.attendence.report.class_report',compact('class'));
   }
   public function student_report_search(Request $request){
   	$class=Student::with('masterClass')->where('school_id',Auth::getSchool())
   						->groupBy(['master_class_id'])
   						->get();
		  $all_student_id=AttenStudent::with('student')
		  					->where([
		   					'month'=>$request->month,'year'=>$request->year,
		   					'master_class_id'=>$request->class,'school_id'=>Auth::getSchool()
		   					])
		   					->groupBy('student_id')
		   				->pluck('student_id')->toArray();
		 $students=Student::with('atten_students','user')->where('school_id',Auth::getSchool())
		 		->whereIn('student_id',$all_student_id)
		 		->get();

   	return view('backEnd.attendence.report.class_report',compact('students','class'));
   }
}
