<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\StudentIdCheck;
use App\Student;
use App\MasterClass;
use App\Testimonial;
use App\School;
use lluminate\Support\Facades\Log;

class TestimonialController extends Controller
{

    public function index(){
        $students = Testimonial::with('masterClass')->where(['school_id'=>Auth::getSchool()])->get();
        return view('backEnd.testimonial.index', ['students'=>$students]);
    }
    public function view($id){
        $student = Testimonial::with('masterClass')->where(['school_id'=>Auth::getSchool(),'id'=>$id])->first();
        $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
        return view('backEnd.testimonial.print_view', ['student'=>$student,'school'=>$school]);
    }
    public function create()
    {
        return view('backEnd.testimonial.create');
    }
    public function storePrint(Request $request)
    {
        $data=$request->all();
        $this->validation($request);
        $data['birth_day']=date('Y-m-d',strtotime($request->birth_day));
        $testimonial_reg_no=Testimonial::where(['school_id'=>Auth::getSchool()])->latest()->value('testimonial_reg_no');
        $data['testimonial_reg_no']=(int)$testimonial_reg_no+1;
        $testimonial=Testimonial::create($data);
        
         return redirect('testimonial/view/'.$testimonial->id);
    }

    public function edit($id){
        $type=Auth::schoolType();
        $school_type_ids=explode('|', $type);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $student = Testimonial::with('masterClass')->where(['school_id'=>Auth::getSchool(),'id'=>$id])->first();
        return view('backEnd.testimonial.edit', ['student'=>$student,'classes'=>$classes]);
    }
    public function update(Request $request,$id)
    {
        $data=$request->except('_token','_method');
        $this->validationUpdate($request,$id);
        $data['birth_day']=date('Y-m-d',strtotime($request->birth_day));

        $testimonial=Testimonial::where('id',$id)->update($data);
        
         return redirect('testimonial/view/'.$id);
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
        return view('backEnd.testimonial.create', ['student'=>$student,'classes'=>$classes]);
    }

    public function validation($request)
    {
        $this->validate($request,[
            "student_id" => ['required','unique:testimonials', 'numeric','digits:15',new StudentIdCheck],
            "name" => "required",
            "father_name" => "required",
            "mother_name" => "required",
            "village" => "required",
            "post_office" => "required",
            "upazila" => "required",
            "district" => "required",
            "exam_session" => "required",
            "gpa" => "required",
            "roll" => "required",
            "reg_no" => "required",
            "board" => "required",
            "session" => "required",
            "exam" => "required",
            "birth_day" => "required",
            "master_class_id" => "required",
            "shift" => "required",
            "section" => "required",
            "group" => "required",
        ]);
    }

    public function validationUpdate($request,$id)
    {
        $this->validate($request,[
            "student_id" => ['required','unique:testimonials,student_id,'.$id, 'numeric','digits:15'],
            "name" => "required",
            "father_name" => "required",
            "mother_name" => "required",
            "village" => "required",
            "post_office" => "required",
            "upazila" => "required",
            "district" => "required",
            "exam_session" => "required",
            "gpa" => "required",
            "roll" => "required",
            "reg_no" => "required",
            "board" => "required",
            "session" => "required",
            "exam" => "required",
            "birth_day" => "required",
            "master_class_id" => "required",
            "shift" => "required",
            "section" => "required",
            "group" => "required",
        ]);
    }
    
    public function destroy($id)
    {
        //
    }
}
