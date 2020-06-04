<?php
namespace App\Collection;

use Illuminate\Database\Eloquent\Collection;
use App\Student;
use App\AttenStudent;
use Auth;

class LeaveCollection extends Collection{
    public function total($query,$status){
        $query['status']=$status;
        $query['school_id']=Auth::getSchool();
    	$total=AttenStudent::where($query)->whereDate('date',date('Y-m-d'))->get()->count();
    	return $total;
    }

    public function total_students($query){
        $query['school_id']=Auth::getSchool();
    	$total=Student::where($query)->get()->count();
    	return $total;
    }

    public function total_absent(){
        $query['status']="A";
        $query['school_id']=Auth::getSchool();
        $total=AttenStudent::where($query)->whereDate('date',date('Y-m-d'))->get()->count();
        return $total;
    }
    public function total_present(){
        $query['status']="P";
        $query['school_id']=Auth::getSchool();
    	$total=AttenStudent::where($query)->whereDate('date',date('Y-m-d'))->get()->count();
    	return $total;
    }

    public function total_leave(){
        $query['status']="L";
        $query['school_id']=Auth::getSchool();
    	$total=AttenStudent::where($query)->whereDate('date',date('Y-m-d'))->get()->count();
    	return $total;
    }

    public function total_holiday(){
        $query['status']="H";
        $query['school_id']=Auth::getSchool();
        $total=AttenStudent::where($query)->whereDate('date',date('Y-m-d'))->get()->count();
        return $total;
    }

    public function atten_students($month,$student_id)
    {
    	$atten_students=AttenStudent::where([
    		'student_id'=>$student_id,
    		'school_id'=>Auth::getSchool()
    	])->whereMonth('date', '=', $month)->orderBy('id','desc')->get();
    	return $atten_students;
    }
}