<?php
namespace App\Collection;

use Illuminate\Database\Eloquent\Collection;
use App\Staff;
use App\AttenEmployee;
use Auth;

class EmployeeLeaveCollection extends Collection{

    public function total_employees($query){
        $query['school_id']=Auth::getSchool();
        $total=Staff::join('users', 'staff.user_id', '=', 'users.id')
        ->where($query)->get()->count();
        return $total;
    }

    public function total($query,$status){
        $query['atten_employees.status']=$status;
        $query['atten_employees.school_id']=Auth::getSchool();
    	$total=AttenEmployee::join('staff', 'atten_employees.staff_id', '=', 'staff.staff_id')
    	                    ->join('users', 'staff.user_id', '=', 'users.id')
    	                    ->where($query)
    	                    ->whereDate('date',date('Y-m-d'))
    	                    ->get()->count();
    	return $total;
    }

    public function total_absent(){
        $query['atten_employees.status']="A";
        $query['atten_employees.school_id']=Auth::getSchool();
    	$total=AttenEmployee::join('staff', 'atten_employees.staff_id', '=', 'staff.staff_id')
    	                    ->join('users', 'staff.user_id', '=', 'users.id')
    	                    ->where($query)
    	                    ->whereDate('date',date('Y-m-d'))
    	                    ->get()->count();
    	return $total;
    }
    public function total_present(){
        $query['atten_employees.status']="P";
        $query['atten_employees.school_id']=Auth::getSchool();
    	$total=AttenEmployee::join('staff', 'atten_employees.staff_id', '=', 'staff.staff_id')
    	                    ->join('users', 'staff.user_id', '=', 'users.id')
    	                    ->where($query)
    	                    ->whereDate('date',date('Y-m-d'))
    	                    ->get()->count();
    	return $total;
    }

    public function total_leave(){
        $query['atten_employees.status']="L";
        $query['atten_employees.school_id']=Auth::getSchool();
    	$total=AttenEmployee::join('staff', 'atten_employees.staff_id', '=', 'staff.staff_id')
    	                    ->join('users', 'staff.user_id', '=', 'users.id')
    	                    ->where($query)
    	                    ->whereDate('date',date('Y-m-d'))
    	                    ->get()->count();
    	return $total;
    }

    public function atten_employees($month,$staff_id)
    {
    	$atten_employees=AttenEmployee::where([
    		'staff_id'=>$staff_id,
    		'school_id'=>Auth::getSchool()
    	])->whereMonth('date', '=', $month)->orderBy('id','desc')->get();
    	return $atten_employees;
    }

    public function total_holiday(){
        $query['status']="H";
        $query['school_id']=Auth::getSchool();
        $total=AttenEmployee::where($query)->whereDate('date',date('Y-m-d'))->get()->count();
        return $total;
    }
}