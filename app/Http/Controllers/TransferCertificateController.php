<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use lluminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\TransferCertificate;
use App\Rules\StudentIdCheck;
use App\MasterClass;
use App\Student;
use App\School;

class TransferCertificateController extends Controller
{
    public function index(){
        $students = TransferCertificate::with('masterClass')->where(['school_id'=>Auth::getSchool()])->get();
        return view('backEnd.transfer_certificate.index', ['students'=>$students]);
    }
    public function view($id){
        $student = TransferCertificate::with('masterClass')->where(['school_id'=>Auth::getSchool(),'id'=>$id])->first();
        $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
        return view('backEnd.transfer_certificate.print_view', ['student'=>$student,'school'=>$school]);
    }
    public function create()
    {
        return view('backEnd.transfer_certificate.create');
    }
    public function storePrint(Request $request)
    {
        $data=$request->all();
        $this->validation($request);
        $data['birth_day']=date('Y-m-d',strtotime($request->birth_day));
        $data['leave_date']=date('Y-m-d',strtotime($request->leave_date));
        $data['date']=date('Y-m-d');
        $tc_reg_no=TransferCertificate::where(['school_id'=>Auth::getSchool()])->latest()->value('tc_reg_no');
        $data['tc_reg_no']=(int)$tc_reg_no+1;
        $tc=TransferCertificate::create($data);
       
        return redirect('transfer_certificate/view/'.$tc->id);
    }
    public function search_student(Request $request)
    {
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();

        $student = Student::with('masterClass','user')->where(['school_id'=>Auth::getSchool(),'student_id'=>$request->student_id])->first();
        if (!$student) {
            return $this->returnWithError(' আপনি শিক্ষার্থীর আইডি নং ভুল দিয়েছেন । ');
        }
        return view('backEnd.transfer_certificate.create', ['student'=>$student,'classes'=>$classes]);
    }
    public function edit($id){
        $type=Auth::schoolType();
        $school_type_ids=explode('|', $type);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $student = TransferCertificate::with('masterClass')->where(['school_id'=>Auth::getSchool(),'id'=>$id])->first();
        return view('backEnd.transfer_certificate.edit', ['student'=>$student,'classes'=>$classes]);
    }
    public function update(Request $request,$id)
    {
        $data=$request->except('_token','_method');
        $this->validationUpdate($request,$id);
        $data['birth_day']=date('Y-m-d',strtotime($request->birth_day));
        $data['leave_date']=date('Y-m-d',strtotime($request->leave_date));
        $tc=TransferCertificate::where('id',$id)->update($data);
       
        return redirect('transfer_certificate/view/'.$id);
    }
    public function validation($request)
    {
        $this->validate($request,[
            "student_id" => ['required','unique:transfer_certificates', 'numeric','digits:15',new StudentIdCheck],
            "name" => "required",
            "father_name" => "required",
            "mother_name" => "required",
            "village" => "required",
            "post_office" => "required",
            "upazila" => "required",
            "district" => "required",
            "reg_no" => "required",
            "from_pay_session" => "required",
            "to_pay_session" => "required",
            "from_session" => "required",
            "to_session" => "required",
            "birth_day" => "required",
            "master_class_id" => "required",
            "previous_class" => "required",
            "is_pass" => "required",
            "shift" => "required",
            "section" => "required",
            "group" => "required",
            "tc_cause" => "required",
            "leave_date" => "required",
        ]);
    }
    public function validationUpdate($request,$id)
    {
        $this->validate($request,[
            "student_id" => ['required','unique:transfer_certificates,student_id,'.$id, 'numeric','digits:15'],
            "name" => "required",
            "father_name" => "required",
            "mother_name" => "required",
            "village" => "required",
            "post_office" => "required",
            "upazila" => "required",
            "district" => "required",
            "reg_no" => "required",
            "from_pay_session" => "required",
            "to_pay_session" => "required",
            "from_session" => "required",
            "to_session" => "required",
            "birth_day" => "required",
            "master_class_id" => "required",
            "previous_class" => "required",
            "is_pass" => "required",
            "shift" => "required",
            "section" => "required",
            "group" => "required",
            "tc_cause" => "required",
            "leave_date" => "required",
        ]);
    }
    public function destroy(TransferCertificate $transferCertificate)
    {
        //
    }
}
