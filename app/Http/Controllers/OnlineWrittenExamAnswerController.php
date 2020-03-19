<?php

namespace App\Http\Controllers;

use App\OnlineWrittenExamAnswer;
use App\OnlineExamResult;
use App\Question;
use App\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
class OnlineWrittenExamAnswerController extends Controller
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
        $tittle="Written";
        $exams=OnlineExamResult::with('subject')
                    ->join('exams','exams.id','=','online_exam_results.exam_id')
                    ->join('master_classes','master_classes.id','=','exams.master_class_id')
                    ->where(['online_exam_results.creator_id'=>Auth::id(),'exams.type'=>2,'online_exam_results.status'=>0])
                    ->select('online_exam_results.*','master_classes.name as class','exams.name as exam_name')
                    ->groupBy('online_exam_results.exam_id')
                    ->get();
        return view('backEnd.online_exam_result.index',compact('exams','tittle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $exam=Exam::where('id',$request->exam_id)->withTrashed()->first();
        $data=$request->except('_token','exam_id');
        $time_stay=(time()*1000)-Session::get('start_time');
        $mark=0;

            $credent['grade']=" ";
            $credent['grade_point']=0;
            $credent['exam_id']=$exam->id;
            $credent['mark']=0;
            $credent['time_stay']=floor(($time_stay % (1000 * 60 * 60)) / (1000 * 60)).'.'.floor(($time_stay % (1000 * 60)) / 1000);
            $credent['result_type']=$exam->result_type;
            $credent['subject_id']=$exam->subject_id;
            $credent['creator_id']=$exam->user_id;
            $credent['status']=0;
            $online_exam_result_id=OnlineExamResult::create($credent);

            if ($data) {
            foreach ($data as $name=>$data) {
                 $question_id=explode('_',$name);
                 $question=Question::where('id',$question_id[0])->withTrashed()->first();
                 if($data){
                    OnlineWrittenExamAnswer::create(['exam_id'=>$request->exam_id,'answer'=>$data[0],'question_id'=>$question_id[0],'full_mark'=>$question->mark,'subject_id'=>$exam->subject_id,'master_class_id'=>$exam->master_class_id,'creator_id'=>$exam->user_id,'online_exam_result_id'=>$online_exam_result_id]);
                }
            }

            Session::forget('end_time');
            Session::forget('start_time');
            return $this->returnWithSuccessRedirect('You have done the exam ! Wait for result.','online-exam/result');
        }else{
            return $this->returnWithError('Please give answer');
        }
    }
    public function evaluateResult(Request $request){
       $data=$request->except('_token','online_exam_result_id');
       $mark=0;
       foreach ($data as $name=>$value) {
           $answer_id=explode('_', $name);
           OnlineWrittenExamAnswer::where('id',$answer_id[1])->update(['status'=>1,'mark'=>$value]);
           $mark=$mark+$value;
       }
       $result=OnlineExamResult::where('id',$request->online_exam_result_id)->first();
       $exam_details=Exam::where('id',$result->exam_id)->first();
        $grade=" ";
        $grade_point=0;

        if($result->result_type==1){
           $grade_mark=($mark*100)/$exam_details->full_mark;
           if ($grade_mark >= 80){
                $grade="A+";
                $grade_point=5;
           }elseif($grade_mark >= 70){
                $grade="A";
                $grade_point=4;
           }elseif($grade_mark >= 60){
                $grade="A-";
                $grade_point=3.5;
           }elseif($grade_mark >= 50){
                $grade="B";
                $grade_point=3;
           }elseif($grade_mark >= 40){
                $grade="C";
                $grade_point=2;
           }elseif($grade_mark >= 33){
                $grade="D";
                $grade_point=1;
           }else{
                $grade="F";
                $grade_point=0;
           }
        }
       OnlineExamResult::where('id',$request->online_exam_result_id)->update(['mark'=>$mark,'status'=>1,'grade'=>$grade,'grade_point'=>$grade_point]);
       return  $this->returnWithSuccessRedirect('Exam evaluation completed !','online-exam/result/creator/'.$exam_details->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\OnlineWrittenExamAnswer  $onlineWrittenExamAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineWrittenExamAnswer $onlineWrittenExamAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlineWrittenExamAnswer  $onlineWrittenExamAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(OnlineWrittenExamAnswer $onlineWrittenExamAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlineWrittenExamAnswer  $onlineWrittenExamAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnlineWrittenExamAnswer $onlineWrittenExamAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlineWrittenExamAnswer  $onlineWrittenExamAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnlineWrittenExamAnswer $onlineWrittenExamAnswer)
    {
        //
    }

}
