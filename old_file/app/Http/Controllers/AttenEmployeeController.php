<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\AttenEmployee;
use App\User;
use App\Staff;
use App\School;
use Carbon\Carbon;
use DB;

class AttenEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function employees()
    {
        $employees = AttenEmployee::join('staff', 'atten_employees.staff_id', '=', 'staff.staff_id')
                    ->join('users', 'staff.user_id', '=', 'users.id')
                    ->groupBy('group_id')
                    ->where('atten_employees.school_id',Auth::getSchool())
                    ->whereDate('date',date('Y-m-d'))
                    ->selectRaw('*,count(atten_employees.id) as total')
                    ->get();

        $total_employees = Staff::where('school_id',Auth::getSchool())->count();
        return view('backEnd.attendence.staff.index',compact('employees','total_employees'));
    }

    public function view($group_id)
    {
        $attendances=AttenEmployee::with(['staff','staff.user'=>function($q) use ($group_id){
                       $q->where('group_id',$group_id); 
                    }])
                     ->where([
                         'school_id'=>Auth::getSchool(),
                         'date'=>date('Y-m-d'),
                     ])->get();
        $attendances = collect($attendances)->filter(function($item, $key) {
                            return ($item->staff->user != NULL);
                       });

        return view('backEnd.attendence.staff.view',compact('attendances','group_id'));
    }

    public function show(Request $request, $staff_id)
    {
       $single_employee=Staff::with('user')->where(['school_id'=>Auth::getSchool(),'staff_id'=>$staff_id])->first();

       $from    = Carbon::parse($request->from)
                        ->startOfDay()
                        ->toDateString();
       $to      = Carbon::parse($request->to)
                        ->endOfDay()
                        ->toDateString();

       if($request->from&&$request->to){
         $months=AttenEmployee::where([
                         'staff_id'=>$staff_id,
                         'school_id'=>Auth::getSchool()
                     ])->whereBetween('created_at',[$from,$to])
                     ->select(DB::raw('MONTH(date) month'))
                     ->groupBy(DB::raw('MONTH(date)'))
                     ->orderBy('id','desc')->get();
       }else{
         $months=AttenEmployee::where([
                         'staff_id'=>$staff_id,
                         'school_id'=>Auth::getSchool()
                     ])
                     ->whereYear('date', '=', date('Y'))
                     ->select(DB::raw('MONTH(date) month'))
                     ->groupBy(DB::raw('MONTH(date)'))
                     ->orderBy('id','desc')->get();
       }

       return view('backEnd.attendence.staff.details',compact('single_employee','months','from','to','request')); 
    }

    public function print_view(Request $request)
    {
        $single_employee=json_decode($request->single_employee);
        $from=$request->from;
        $to=$request->to;
        $months=json_decode($request->months);
        $school=School::where('id',Auth::getSchool())->first();
        return view('backEnd.attendence.staff.print_view',compact('single_employee','months','from','to','school'));
    }
    
}
