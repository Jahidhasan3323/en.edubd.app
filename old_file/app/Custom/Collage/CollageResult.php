<?php

namespace App\Custom\Collage;
use App\ExamType;
use App\MasterClass;
use App\Result;
use App\School;
use App\Student;
use App\Subject;
use App\Teacher;
use App\Unit;
use App\GroupClass;
use App\SchoolType;
use App\User;
use function GuzzleHttp\Psr7\copy_to_stream;
use Illuminate\CustomClasses\ResultCalculate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Rules\ResultEntryCheck;

class CollageResult extends Controller
{   
    public $link;
    public function __construct()
    {  
        $this->link='Home';
        $this->middleware('auth');
    }

    
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        foreach ($request->subject_name as $key => $subject) {
          if($request->subject_status[$key]!=null){
             $check_mark = $this->check_mark_proccess($key,$request);
             $total=$this->per_subjet_sub_total_mark($check_mark);
             $data=[
               "exam_type_id" => $request->exam_type_id,
               "exam_year" => $request->exam_year,
               "student_id" => $request->student_id,
               "roll" => $request->roll,
               "master_class_id" => $request->master_class_id,
               "group_class_id" => $request->group_class_id,
               "shift" => $request->shift,
               "section" => $request->section,
               "subject_name" => $subject,
               "ca_mark" => $request->ca_mark[$key],
               "cr_mark" => $request->cr_mark[$key],
               "mcq_mark" => $request->mcq_mark[$key],
               "pr_mark" => $request->pr_mark[$key],
               "sub_total" => "$total",
               "ca_pass_mark" => $request->ca_pass_mark[$key],
               "cr_pass_mark" => $request->cr_pass_mark[$key],
               "mcq_pass_mark" => $request->mcq_pass_mark[$key],
               "pr_pass_mark" => $request->pr_pass_mark[$key],
               "total_pass_mark" => $request->total_pass_mark[$key],
               "total_mark" => $request->total_mark[$key],
               "subject_type" => $request->subject_type[$key],
               "subject_status"=> $request->subject_status[$key],
               "school_id"=> Auth::getSchool()
               ];
               Result::insert($data);
          }
        }
    }

    protected function check_mark_proccess($key,$request){
       $check_mark['ca_mark']=($request->ca_mark[$key]=='--'?0:$request->ca_mark[$key]);
       $check_mark['cr_mark']=($request->cr_mark[$key]=='--'?0:$request->cr_mark[$key]);
       $check_mark['mcq_mark']=($request->mcq_mark[$key]=='--'?0:$request->mcq_mark[$key]);
       $check_mark['pr_mark']=($request->pr_mark[$key]=='--'?0:$request->pr_mark[$key]);
    
       return $check_mark; 
    }
    protected function per_subjet_sub_total_mark($check_mark){
       $total_without_ca_mark=$check_mark['cr_mark']+$check_mark['mcq_mark']+$check_mark['pr_mark'];
       if($check_mark['ca_mark']==0){
          $total=$total_without_ca_mark;
       }else{
          $total=$check_mark['ca_mark']+(($total_without_ca_mark*80)/100);
       }
        return $total;
    }

    public function getResult(Request $request)
    {
        $this->validate($request, [
            'exam_year' => 'required',
            'exam_type_id' => 'required',
            'student_id' => 'required|min:15|max:15',
        ]);
        
        $result=Result::with(['student','student.user','master_class','group_class'])->where([
            'exam_year'=>$request->exam_year,
            'exam_type_id'=>$request->exam_type_id,
            'student_id'=>$request->student_id,
            'school_id'=> Auth::getSchool()
        ])->groupBy(['student_id','subject_name'])->get();
        
       $newCollections = collect($result)->groupBy(function($element){
        return str_replace(['১ম','২য়','১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র'], '', $element['subject_name']);
       });
       foreach ($newCollections as $key => $news) {
         foreach ($news as $key => $new) {
           echo "<p>".$new->subject_name."</p> <br>";
         }
       }

       exit();
        $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();

        if($result->status==0){
          Session::flash('errmgs', 'Opps, Result not published yet.');
          return redirect()->back();
        }
        if ($result->count()){
            $exam = ExamType::where('id',$request->exam_type_id)->first();
            return view('backEnd.results.view', compact('result','exam','request','school'));
        }
        Session::flash('errmgs', 'Opps, No result found !');
        return redirect()->back();
    }
    
}
  

@if(in_array('ঐচ্ছিক',json_decode($result->subject_status)))
<h4 style="font-size: 14px;">অতিরিক্ত বিষয়</h4>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>ক্রমিক নং</th>
        <th>বিষয়ের নাম</th>
  @if(in_array($result->master_class_id,['8','9','10','11','12']))
        <th>সিএ</th>
  @endif
        <th>{{in_array($result->master_class_id,['8','9','10','11','12'])?'সিআর':'তত্ত্বীয়'}}</th>
        <th>এমসিকিউ</th>
        <th>পিআর</th>
        <th>মোট নম্বর</th>
        <th>লেটার গ্রেড</th>
        <th>জিপিএ</th>
      </tr>
    </thead>
    <tbody>
      @php($serial_4j=1)
      @foreach(json_decode($result->sub_total) as $key=>$sub_total)
       @if(json_decode($result->subject_status)[$key]=='ঐচ্ছিক')
       <tr>
         <td>{{$serial_4j++}}</td>
         <td>{{json_decode($result->subject_name)[$key]}}</td>
@if(in_array($result->master_class_id,['8','9','10','11','12']))
         <td>{{json_decode($result->ca_mark)[$key]}}</td>
@endif
         <td>{{json_decode($result->cr_mark)[$key]}}</td>
         <td>{{json_decode($result->mcq_mark)[$key]}}</td>
         <td>{{json_decode($result->pr_mark)[$key]}}</td>
         <td>{{$sub_total}}</td>
         <td>{{Auth::grade(json_decode($result->sub_gpa)[$key])}}</td>
         <td>{{json_decode($result->sub_gpa)[$key]}}</td>
       </tr>
       @endif
      @endforeach
    </tbody>
  </table>
  <span class="fainal-result">
  <p>প্রাপ্ত জিপিএ ( অতিরিক্ত বিষয় সহ ) &nbsp; &nbsp; &nbsp; &nbsp; : {{$result->gpa}}</p>
  </span>
@endif