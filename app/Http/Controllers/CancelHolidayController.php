<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holiday;
use App\CancelHoliday;
use Auth;
use Session;
use DB;

class CancelHolidayController extends Controller
{

    public $months = Array ('January','February','March','April','May','June','July','August','September','October','November','December');
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $cancel_holidays =CancelHoliday::whereYear('date', '=', date('Y'))
                   ->where('school_id',Auth::getSchool())
                   ->groupBy(DB::raw('MONTH(date)'))
                   ->select('*', DB::raw('count(*) as total'))
                   ->get();
        $months = $this->months;
        return view('backEnd.holiday.cancel.index',compact('cancel_holidays','months'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $months = $this->months;
         $days = array();
         if($request->all()){
             $this->validate($request,[
                 'year'=>'required',
                 'month'=>'required',
             ]);
             $days = Holiday::where('school_id',0)
               ->whereYear('date', '=', $request->year)
               ->whereMonth('date', '=', $request->month)
               ->select('date')->get();
             $cancel_holidays=CancelHoliday::where('school_id',Auth::getSchool())
             ->pluck('date')->map(function ($date) {
                return $date->format('Y-m-d');
             })->toArray();
         }
         
         $months = json_encode($months);
         $search = $request->except('_token');
         return view('backEnd.holiday.cancel.create',compact('days','months','search','cancel_holidays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          try {
             foreach ($request->date as $key => $date) {
                 $check = CancelHoliday::whereDate('date',date('Y-m-d',strtotime($date)))
                 ->where('school_id',Auth::getSchool())
                 ->get();
                 if(count($check)<1){
                   $data['date']=date('Y-m-d',strtotime($date));
                   $data['school_id']=Auth::getSchool();
                   CancelHoliday::create($data);
                 }
             }

             Session::flash('sccmgs', 'ছুটি সফলভাবে বাতিল করা হয়েছে !');
             return redirect()->back();
          } catch (\Exception $e) {
              Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
              return redirect()->back();
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($month,$year)
    {
        $cancel_holidays = CancelHoliday::whereMonth('date', '=', date('m'))
                   ->whereYear('date', '=', date('Y'))
                   ->where(['school_id'=>Auth::getSchool()])
                   ->get();
        $months = $this->months;
        return view('backEnd.holiday.cancel.show',compact('cancel_holidays','month','year','months'));
    }

    public function destroy($id,$month,$year)
    {
        try {
           CancelHoliday::whereMonth('date', '=', date('m'))
                              ->whereYear('date', '=', date('Y'))
                              ->where(['id'=>$id,'school_id'=>Auth::getSchool()])
                              ->delete();

           Session::flash('sccmgs', 'ছুটি সফলভাবে বাতিল করা হয়েছে !');
           return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }
}
