<?php

namespace App\Http\Controllers;

use App\OnlineAdmission;
use App\OnlineAdmissionApplication;
use App\OnlineAdmissionApplicationSubject;
use App\OnlineAdmissionAccademicInfo;
use Illuminate\Http\Request;
use Auth;
use Validator;
class OnlineAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $title="অনলাইন ভর্তি";

        $online_admission=OnlineAdmission::where(['creator_id'=>Auth::id(),'school_id'=>Auth::getSchool()])->get();
        return view('backEnd.online_admission.index',compact('online_admission','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        return view('backEnd.online_admission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $this->validate($request, [
            'title' => 'required',
            'session' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
        ]);
        OnlineAdmission::where('status',1)->update(['status'=>0]);
        OnlineAdmission::create($data);

        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','online_admission');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OnlineAdmission  $onlineAdmission
     * @return \Illuminate\Http\Response
     */
    public function application($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $title="অনলাইন ভর্তি আবেদন লিস্ট";

         $online_admission=OnlineAdmissionApplication::where(['online_admission_id'=>$id,'school_id'=>Auth::getSchool(),'status'=>1])->get();
         $status=1;
        return view('backEnd.online_admission.application',compact('online_admission','title','id','status'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlineAdmission  $onlineAdmission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $title="অনলাইন ভর্তি";

        $online_admission=OnlineAdmission::where(['creator_id'=>Auth::id(),'school_id'=>Auth::getSchool(),'id'=>$id])->first();
        return view('backEnd.online_admission.edit',compact('online_admission','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlineAdmission  $onlineAdmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $this->validate($request, [
            'title' => 'required',
            'session' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if($request->status==1){
            OnlineAdmission::where('status',1)->update(['status'=>0]);
            OnlineAdmission::where('id',$id)->update($data);
        }else{
            OnlineAdmission::where('id',$id)->update($data);
        }
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','online_admission');
    } 



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlineAdmission  $onlineAdmission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $question=OnlineAdmission::where(['id'=>$id,'school_id'=> Auth::getSchool()])->delete();
        
        return $this->returnWithSuccess('আপনার তথ্য মুছে ফেলা হয়েছে !');
    }

    public function view($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }

         $student=OnlineAdmissionApplication::where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
         $subject=OnlineAdmissionApplicationSubject::where(['o_a_application_id'=>$id,'school_id'=>Auth::getSchool(),'status'=>1])->get();
        $accademic_info=OnlineAdmissionAccademicInfo::where(['o_a_application_id'=>$id,'school_id'=>Auth::getSchool(),'status'=>1])->get();
        return view('backEnd.online_admission.view',compact('student','subject','accademic_info'));
    }

    public function add_merit($id)
    {
        OnlineAdmissionApplication::where(['id'=>$id,'school_id'=> Auth::getSchool()])->update(['status'=>2]);
        return $this->returnWithSuccess('আপনার তথ্য সংরক্ষণ হয়েছে !');
    }
    public function add_waiting($id)
    {
        OnlineAdmissionApplication::where(['id'=>$id,'school_id'=> Auth::getSchool()])->update(['status'=>3]);
        return $this->returnWithSuccess('আপনার তথ্য সংরক্ষণ হয়েছে !');
    }
    public function add_reject($id)
    {
        OnlineAdmissionApplication::where(['id'=>$id,'school_id'=> Auth::getSchool()])->update(['status'=>0]);
        return $this->returnWithSuccess('আপনার তথ্য সংরক্ষণ হয়েছে !');
    }

    public function application_delete($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $question=OnlineAdmissionApplication::where(['id'=>$id,'school_id'=> Auth::getSchool()])->delete();
        
        return $this->returnWithSuccess('আপনার তথ্য মুছে ফেলা হয়েছে !');
    }

    public function application_activity_list($id,$status)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $title="অনলাইন ভর্তি আবেদন লিস্ট";
         $online_admission=OnlineAdmissionApplication::where(['online_admission_id'=>$id,'school_id'=>Auth::getSchool(),'status'=>$status])->get();
        return view('backEnd.online_admission.application',compact('online_admission','title','status','id'));
    }

}
