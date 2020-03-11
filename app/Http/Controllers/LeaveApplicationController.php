<?php

namespace App\Http\Controllers;

use App\LeaveApplication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_application()
    {
        if(Auth::is('teacher') || Auth::is('staff') || Auth::is('student')){
           $tittle='ছুটির আবেদন ';
            $leave_applications=LeaveApplication::where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id()])->orderby('id','DESC')->get();
        return view('backEnd.leave_application.index',compact('leave_applications','tittle'));
        }else{
             return redirect('/home');
        }

    }
    public function index()
    {
        if(!Auth::is('admin')){
             return redirect('/home');

        }
        $tittle='প্রক্রিয়াধীন ছুটির আবেদন ';
            $leave_applications=LeaveApplication::where(['school_id'=> Auth::getSchool(),'status'=>0])->orderby('id','DESC')->get();
        return view('backEnd.leave_application.index',compact('leave_applications','tittle'));

    }

    public function accept_list()
    {
        if(!Auth::is('admin')){
             return redirect('/home');

        }
        $tittle='গ্রহণ করা ছুটির আবেদন ';
            $leave_applications=LeaveApplication::where(['school_id'=> Auth::getSchool(),'status'=>1])->orderby('id','DESC')->get();
        return view('backEnd.leave_application.index',compact('leave_applications','tittle'));

    }
    public function cancle_list()
    {
        if(!Auth::is('admin')){
             return redirect('/home');

        }
        $tittle='বাতিল করা ছুটির আবেদন ';
            $leave_applications=LeaveApplication::where(['school_id'=> Auth::getSchool(),'status'=>2])->orderby('id','DESC')->get();
        return view('backEnd.leave_application.index',compact('leave_applications','tittle'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::is('teacher') || Auth::is('staff') || Auth::is('student')){

            return view('backEnd.leave_application.add');
        }else{
             return redirect('/home');
        }

         return view('backEnd.leave_application.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if(Auth::is('teacher') || Auth::is('staff') || Auth::is('student')){

       $data=$request->all();

        $this->validate($request, [
            'form_date' => 'required',
            'to_date' => 'required',
            'total_day' => 'required|numeric',
            'purpose' => 'required',
            'due_leave' => 'numeric',
            'leave_type' => 'required',
        ]);
         $data['form_date']=date_format(date_create($request->form_date),"Y-m-d");
         $data['to_date']=date_format(date_create($request->to_date),"Y-m-d");

         if(Auth::is('teacher') || Auth::is('staff')){
            $data['user_type']=1;
         }
         if(Auth::is('student')){
             $data['user_type']=2;
         }

        LeaveApplication::create($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','leave_application');
    }else{
        return redirect('/home');

        }
    }

    public function accept($id)
    {
       if (!Auth::is('admin')){
            return redirect('/home');
        }
        LeaveApplication::where('id',$id)->update(['status'=>1]);

        return $this->returnWithSuccess('আবেদন পত্র গ্রহণ করা হয়েছে ');
    }
    public function cancle($id)
    {
       if (!Auth::is('admin')){
            return redirect('/home');
        }
        LeaveApplication::where('id',$id)->update(['status'=>2]);

        return $this->returnWithSuccess('আবেদন পত্র বাতিল করা হয়েছে ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveApplication  $leaveApplication
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         if( Auth::is('teacher') || Auth::is('staff')  ){
             $leave_application=LeaveApplication::with([
             'staff','staff.user','staff.designation','school','school.user'
             ])->where(['school_id'=> Auth::getSchool(),'id'=>$id])->first();
            return view('backEnd.leave_application.view',compact('leave_application'));
         }elseif(Auth::is('student')){
            $leave_application=LeaveApplication::with([
             'student','student.user','student.masterClass','school','school.user'
             ])->where(['school_id'=> Auth::getSchool(),'id'=>$id])->first();
            return view('backEnd.leave_application.view_student',compact('leave_application'));
         }elseif(Auth::is('admin') ){
            $usertype=LeaveApplication::where(['school_id'=> Auth::getSchool(),'id'=>$id])->first();
            if ($usertype->user_type==1) {
                $leave_application=LeaveApplication::with([
                'staff','staff.user','staff.designation','school','school.user'
                ])->where(['school_id'=> Auth::getSchool(),'id'=>$id])->first();
                return view('backEnd.leave_application.view',compact('leave_application'));
            }else{
                $leave_application=LeaveApplication::with([
                 'student','student.user','student.masterClass','school','school.user'
                 ])->where(['school_id'=> Auth::getSchool(),'id'=>$id])->first();
                return view('backEnd.leave_application.view_student',compact('leave_application'));
            }
         }else{
            return redirect('/home');
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveApplication  $leaveApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveApplication $leaveApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveApplication  $leaveApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveApplication $leaveApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveApplication  $leaveApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveApplication $leaveApplication)
    {
        //
    }
}
