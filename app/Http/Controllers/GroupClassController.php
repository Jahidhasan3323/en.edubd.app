<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\GroupClass;
use Session;

class GroupClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_groups=GroupClass::all();
        return view('backEnd.groupClass.info',compact('class_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backEnd.groupClass.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::is('root')){
           return redirect('home');
        }
        $this->validate($request, [
            'name' => 'required',
            ]);
        $check=GroupClass::where(['name'=>$request->name])->first();
        if($check){
            Session::flash('errmgs', 'দুঃখিত, এই গ্রুপটি পূর্বেই যোগ করা হয়েছে !');
            return redirect()->back();
        }
        GroupClass::create(['name'=>$request->name]);
        Session::flash('sccmgs', 'শ্রেণী গ্রুপ সফলভাবে যোগ করা হয়েছে !');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group_class=GroupClass::where(['id'=>$id])->first();
        return view('backEnd.groupClass.edit',compact('group_class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!Auth::is('root')){
           return redirect('home');
        }
        $check=GroupClass::where(['name'=>$request->name])->first();
        if($check){
            Session::flash('errmgs', 'দুঃখিত, এই গ্রুপটি পূর্বেই যোগ করা হয়েছে !');
            return redirect()->back();
        }
        GroupClass::where(['id'=>$request->id])->update(['name'=>$request->name]);
        Session::flash('sccmgs', 'শ্রেণী গ্রুপ সফলভাবে আপডেট করা হয়েছে  !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GroupClass::where(['id'=>$id])->delete();
        Session::flash('sccmgs', 'শ্রেণী গ্রুপ সফলভাবে মুছে ফেলা হয়েছে  !');
        return redirect()->back();
    }
}
