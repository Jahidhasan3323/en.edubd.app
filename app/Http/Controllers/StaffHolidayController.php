<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\AttenEmployee;
use App\Holiday;

class StaffHolidayController extends Controller
{
    public $months = Array ('January','February','March','April','May','June','July','August','September','October','November','December');
    public function create(Request $request)
    {
        /*$num_of_days = date('t',mktime (0,0,0,$month,1,$year));*/
               $months = $this->months;
                $days = array();
                if($request->all()){
                    $this->validate($request,[
                        'year'=>'required',
                        'month'=>'required',
                    ]);
                    $num_of_days = date('t',mktime (0,0,0,$request->month,1,$request->year));
                    for( $i=1; $i<= $num_of_days; $i++) {
                       $time=mktime(0, 0, 0, $request->month, $i, $request->year);
                       $days[] = date('l d-m-Y', $time);
                    }
                }
                $holidays = Holiday::where([
                                     'school_id'=>Auth::getSchool(),
                                     'month'=>$request->month,
                                     'year'=>$request->year,
                                   ])->select('date')->get();
                $public_holidays = array();
                if($holidays){
                   foreach ($holidays as $holiday) {
                       $public_holidays[] = $holiday->date;
                   }
                }
                $months = json_encode($months);
                $days = json_encode($days);
                $search = $request->except('_token');
                return view('backEnd.attendence.holiday.create',compact('days','months','search','public_holidays'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'staff_id'=>'required|numeric|digits:12',
            'date'=>'required'
        ]);
        foreach ($request->date as $date) {
            $data = $request->except('date');
            $data['school_id']=Auth::getSchool();
            $data['date']=$date;
            $check=AttenEmployee::where([
                     'school_id'=>Auth::getSchool(),
                     'staff_id'=>$data['staff_id'],
                     'date'=>$data['date'],
                     'month'=>$data['month'],
                     'year'=>$data['year'],
                   ])->get();
            if(count($check)<1){AttenEmployee::create($data);}
        }
        Session::flash('sccmgs', 'স্টাফ, েন্ট্রি সফল হয়েছে !');
        return redirect()->back();
    }

}
