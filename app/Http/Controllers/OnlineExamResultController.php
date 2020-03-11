<?php

namespace App\Http\Controllers;

use App\OnlineExamResult;
use App\OnlineWrittenExamAnswer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use App\Exam;
use Auth;

class OnlineExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=OnlineExamResult::with('exam','subject')->where(['user_id'=>Auth::id(),'school_id'=>Auth::getSchool()])->get();
        return view('backEnd.online_exam_result.result',compact('results'));
    }

    public function creatorResult($id)
    {
        $results=OnlineExamResult::with('exam','subject')->where(['exam_id'=>$id,'school_id'=>Auth::getSchool()])->get();
        return view('backEnd.online_exam_result.creator_result',compact('results'));
    }
    public function pendingResult($id,$exam_id)
    {
        $results=OnlineExamResult::with('exam','subject')->where(['exam_id'=>$exam_id,'school_id'=>Auth::getSchool(),'status'=>0])->get();
        return view('backEnd.online_exam_result.pending_result',compact('results','id'));
    }
    public function evaluateResult($id)
    {
        $results=OnlineWrittenExamAnswer::with('exam','subject','question')->where(['online_exam_result_id'=>$id,'school_id'=>Auth::getSchool(),'status'=>0,'creator_id'=>Auth::id()])->get();
        return view('backEnd.online_exam_result.evaluate_result',compact('results','id'));
    }
    public function evaluateResultEdit($id)
    {
        $results=OnlineWrittenExamAnswer::with('exam','subject','question')->where(['online_exam_result_id'=>$id,'school_id'=>Auth::getSchool(),'creator_id'=>Auth::id()])->get();
        return view('backEnd.online_exam_result.evaluate_result_edit',compact('results','id'));
    }
    public function evaluateResultView($id)
    {
        $results=OnlineWrittenExamAnswer::with('exam','subject','question')->where(['online_exam_result_id'=>$id,'school_id'=>Auth::getSchool(),'creator_id'=>Auth::id()])->get();
        return view('backEnd.online_exam_result.evaluate_result_view',compact('results','id'));
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
        $mark=0;
        foreach ($data as $name=>$data) {
            $question_id=explode('_',$name);
            $answer=Question::where('id',$question_id[1])->withTrashed()->first();
            if($data==$answer->answer){
                $mark=$mark+$answer->mark;
            }
        }
        $credent['grade']=" ";
        $credent['grade_point']=0;

        if($exam->result_type==1){
           $grade_mark=($mark*100)/$exam->full_mark;
           if ($grade_mark >= 80){
                $credent['grade']="A+";
                $credent['grade_point']=5;
           }elseif($grade_mark >= 70){
                $credent['grade']="A";
                $credent['grade_point']=4;
           }elseif($grade_mark >= 60){
                $credent['grade']="A-";
                $credent['grade_point']=3.5;
           }elseif($grade_mark >= 50){
                $credent['grade']="B";
                $credent['grade_point']=3;
           }elseif($grade_mark >= 40){
                $credent['grade']="C";
                $credent['grade_point']=2;
           }elseif($grade_mark >= 33){
                $credent['grade']="D";
                $credent['grade_point']=1;
           }else{
                $credent['grade']="F";
                $credent['grade_point']=0;
           }
        }
        $credent['exam_id']=$exam->id;
        $credent['mark']=$mark;
        $credent['time_stay']=0;
        $credent['result_type']=$exam->result_type;
        $credent['subject_id']=$exam->subject_id;
        $credent['creator_id']=$exam->user_id;
        $credent['status']=1;

        OnlineExamResult::create($credent);
        return $this->returnWithSuccessRedirect('আপনার পরীক্ষা সম্পূর্ণ হয়েছে ! আপনি '.$mark.' নাম্বার পেয়েছেন ।','online-exam/result'); 
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\OnlineExamResult  $onlineExamResult
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineExamResult $onlineExamResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlineExamResult  $onlineExamResult
     * @return \Illuminate\Http\Response
     */
    public function edit(OnlineExamResult $onlineExamResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlineExamResult  $onlineExamResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnlineExamResult $onlineExamResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlineExamResult  $onlineExamResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnlineExamResult $onlineExamResult)
    {
        //
    }
}
