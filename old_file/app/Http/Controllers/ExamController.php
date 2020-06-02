<?php

namespace App\Http\Controllers;

use App\Exam;
use App\School;
use App\Subject;
use App\Question;
use App\Student;
use App\GroupClass;
use App\MasterClass;
use App\ExamQuestion;
use App\OnlineExamResult;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $tittle="MCQ";

        $exams=Exam::with('masterClass','group_class','subject')->where(['user_id'=>Auth::id(),'type'=>1])->get();
        return view('backEnd.exam_question.index',compact('exams','tittle'));
    }
    public function written()
    {
        if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $tittle="Written";
        $exams=Exam::with('masterClass','group_class','subject')->where(['user_id'=>Auth::id(),'type'=>2])->get();
        return view('backEnd.exam_question.index',compact('exams','tittle'));
    }
    public function student_mcq()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $tittle="MCQ";
        $student=Student::where('user_id',Auth::id())->first();
        $group_class=GroupClass::where('name',$student->group)->value('id');
        $exams=Exam::with('masterClass','group_class','subject')->where(['type'=>1,'master_class_id'=>$student->master_class_id,'group_class_id'=>$group_class,'section'=>$student->section,'shift'=>$student->shift,'school_id'=>Auth::getSchool()])->get();
        return view('backEnd.exam_question.student_mcq_exam',compact('exams','tittle'));
    }
    public function student_written()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $tittle="Written";
        $student=Student::where('user_id',Auth::id())->first();
        $group_class=GroupClass::where('name',$student->group)->value('id');
        $exams=Exam::with('masterClass','group_class','subject')->where(['type'=>2,'master_class_id'=>$student->master_class_id,'group_class_id'=>$group_class,'section'=>$student->section,'shift'=>$student->shift,'school_id'=>Auth::getSchool()])->get();
        return view('backEnd.exam_question.student_mcq_exam',compact('exams','tittle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $type=Auth::schoolType();
        $school_type_ids=explode('|', $type);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $group_classes=GroupClass::get();
        $subjects=Subject::where('school_id',Auth::getSchool())->get();
        return view('backEnd.exam_question.create',compact('group_classes','classes','subjects'));
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
            'name' => 'required',
            'full_mark' => 'required',
            'master_class_id' => 'required',
            'group_class_id' => 'required',
            'shift' => 'required',
            'section' => 'required',
            'subject_id' => 'required',
            'time' => 'required',
            'type' => 'required',
            'exam_type' => 'required',

        ]);

        if($request->exam_type==1){
            $this->validate($request, [
            'pass_mark' => 'required',
            'result_type' => 'required',
            'exam_option' => 'required',


        ]);
        }
        Exam::create($data);
        if($request->type==1){
            return $this->returnWithSuccessRedirect('Your information added successfully !','exam/mcq');
        }else{
            return $this->returnWithSuccessRedirect('Your information added successfully !','exam/written');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $exam=Exam::with('masterClass','group_class','subject')->where(['id'=>$id,'user_id'=>Auth::id(),'school_id'=>Auth::getSchool()])->first();
        $questions=ExamQuestion::with('questions')->where(['exam_id'=>$id])->get();
        $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
        return view('backEnd.exam_question.print_view',compact('exam','school','questions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $type=Auth::schoolType();
        $school_type_ids=explode('|', $type);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $group_classes=GroupClass::get();
        $subjects=Subject::where('school_id',Auth::getSchool())->get();
        $exam=Exam::with('masterClass','group_class','subject')->where(['id'=>$id,'user_id'=>Auth::id(),'school_id'=>Auth::getSchool()])->first();
        return view('backEnd.exam_question.edit',compact('exam','group_classes','classes','subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $data=$request->except('_method','_token');
        $this->validate($request, [
            'name' => 'required',
            'full_mark' => 'required',
            'master_class_id' => 'required',
            'group_class_id' => 'required',
            'shift' => 'required',
            'section' => 'required',
            'subject_id' => 'required',
            'time' => 'required',
            'type' => 'required',
            'exam_type' => 'required',

        ]);

        if($request->exam_type==1){
            $this->validate($request, [
            'pass_mark' => 'required',
            'result_type' => 'required',
            'exam_option' => 'required',


        ]);
        }

        Exam::where('id',$id)->update($data);
        if($request->type==1){
            return $this->returnWithSuccessRedirect('Your information added successfully !','exam/mcq');
        }else{
            return $this->returnWithSuccessRedirect('Your information added successfully !','exam/written');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }

        $exam = Exam::withTrashed()->where(['id'=> $id,'user_id'=>Auth::id()])->first();
        $exam->delete();
         if($exam->type==1){
            return $this->returnWithSuccessRedirect('Your information added successfully !','exam/mcq');
        }else{
            return $this->returnWithSuccessRedirect('Your information added successfully !','exam/written');
        }
    }

    public function exam_question_mcq($id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $exam=Exam::where(['id'=>$id,'user_id'=>Auth::id()])->first();

        $questions=Question::with('options','masterClass','user','school')->withTrashed()->where(['subject_id'=>$exam->subject_id,'type'=>1])->orderby('id','DESC')->get();
        return view('backEnd.exam_question.question_list',compact('questions','id'));
    }
    public function exam_question_written($id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $exam=Exam::where(['id'=>$id,'user_id'=>Auth::id()])->first();

        $questions=Question::with('options','masterClass','user','school')->withTrashed()->where(['subject_id'=>$exam->subject_id,'type'=>2])->orderby('id','DESC')->get();
        return view('backEnd.exam_question.question_list',compact('questions','id'));
    }
    public function exam_question_store(Request $request,$id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $this->validate($request, [
            'question_id' => 'required',

        ]);

        $exam_question=ExamQuestion::where(['exam_id'=>$id])->delete();

        foreach($request->question_id as $question_id) {
            ExamQuestion::create(['exam_id'=>$id,'question_id'=>$question_id]);
        }
        return $this->returnWithSuccessRedirect('Your information added successfully !','exam/question/'.$id);


    }

    public function mcq_question($id)
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $exam=Exam::with('masterClass','group_class','subject')->where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
        $result=OnlineExamResult::where(['exam_id'=>$id, 'user_id'=>Auth::id()])->first();
        if ($exam->exam_option==1 && !empty($result)) {
            return $this->returnWithError('You already attend the exam.');
        }
        $questions=ExamQuestion::with('questions')->where(['exam_id'=>$id])->get();
        $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
        /*Session::forget('end_time');
        return "yes";*/
        //Session::forget('end_time');
        if(!Session::get('end_time')){
         Session::put('end_time', date('M d, Y H:i:s', strtotime('+'. $exam->time .' minutes')));
         Session::put('start_time',time() * 1000);
        }
        return view('backEnd.exam_question.student_mcq_exam_question',compact('exam','school','questions'));
    }
    public function written_question($id)
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $exam=Exam::with('masterClass','group_class','subject')->where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
        $result=OnlineExamResult::where(['exam_id'=>$id, 'user_id'=>Auth::id()])->first();
        if ($exam->exam_option==1 && !empty($result)) {
            return $this->returnWithError('You already attend the exam.');
        }
        $questions=ExamQuestion::with('questions')->where(['exam_id'=>$id])->get();
        $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
        if(!Session::get('end_time')){
            Session::put('end_time', date('M d, Y H:i:s', strtotime('+'. $exam->time .' minutes')));
            Session::put('start_time',time() * 1000);
        }
        return view('backEnd.exam_question.student_written_exam_question',compact('exam','school','questions'));
    }
}
