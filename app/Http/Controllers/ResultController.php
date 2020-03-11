<?php

namespace App\Http\Controllers;
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
use App\CaResult;
use App\User;
use function GuzzleHttp\Psr7\copy_to_stream;
use Illuminate\CustomClasses\ResultCalculate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Rules\ResultEntryCheck;
use Illuminate\Support\Collection;
use App\Http\Controllers\ResultListController;

class ResultController extends Controller
{
    public $link;
    public function __construct()
    {
        $this->link='Home';
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student') && !Auth::is('commitee') && !Auth::is('staff')){
            return redirect('/home');
        }
        $exams = $this->getExams();
        $years = $this->exam_year();
        $classes = $this->getClasses();
        return view('backEnd.results.info', compact('classes','years','exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $classes =$this->getClasses();
        $group_classes =GroupClass::all();
        $units =$this->getUnits();
        $group_class=GroupClass::where('id',$request->group_class_id)->select('name')->first();
        $students=array();
        $subjects=array();
        if($request->all()){
            $students= Student::with('user')->where([
                'master_class_id'=>$request->master_class_id,
                'group'=>$group_class->name,
                'section'=>$request->section,
                'shift'=>$request->shift,
                'school_id'=>Auth::getSchool()
            ])->current()->get();
            $subjects = Subject::where([
                'master_class_id'=>$request->master_class_id,
                'group_class_id'=>$request->group_class_id,
                'school_id'=>Auth::getSchool()
            ])->get();
         }
        $exam_types = ExamType::all();
        $search= $request->all();
        return view('backEnd.results.create', compact('classes','group_classes','units','students','subjects','exam_types','search'));
    }


    public function student_roll(Request $request){
           $student_roll= Student::where([
            'student_id'=>$request->student_id,
            'school_id'=>Auth::getSchool(),
           ])->select('roll')->first();
           return $student_roll;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $this->create_result_validation($request);
        $grand_total_mark=$this->grand_total_mark_procesing($request);
        foreach ($request->subject_name as $key => $subject) {
          if($request->subject_status[$key]!=null){
             $check_mark = $this->check_mark_proccess($key,$request);
             $total=$this->per_subjet_sub_total_mark($check_mark);
             $data=$this->data_proccess($request,$subject,$key,$total,$grand_total_mark);
             Result::create($data);
          }
        }

        return $this->returnWithSuccess('ফলাফল এন্ট্রি সফল হয়েছে ।');
    }

    protected function grand_total_mark_procesing($request){
        foreach ($request->subject_status as $key => $status) {
          if($status!=null){
            $ca_marks=($request->ca_mark[$key]=='--'?0:$request->ca_mark[$key]);
            $cr_marks=($request->cr_mark[$key]=='--'?0:$request->cr_mark[$key]);
            $mcq_marks=($request->mcq_mark[$key]=='--'?0:$request->mcq_mark[$key]);
            $pr_marks=($request->pr_mark[$key]=='--'?0:$request->pr_mark[$key]);
            if($ca_marks==0){
              $grand_total_mark[]=$ca_marks+$cr_marks+$mcq_marks+$pr_marks;
            }else{
              $grand_total_mark[]=$ca_marks+((($cr_marks+$mcq_marks+$pr_marks)*80)/100);
            }
          }
        }
       return array_sum($grand_total_mark);
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

    protected function data_proccess($request,$subject,$key,$total,$grand_total_mark){
       $regularity=Student::where([
        'student_id'=>$request->student_id,'school_id'=>Auth::getSchool(),
        'master_class_id'=>$request->master_class_id,'shift'=>$request->shift,
        'section'=>$request->section,'group'=>GroupClass::where(['id'=>$request->group_class_id])->value('name')
       ])->value('regularity');
       return [
               "exam_type_id" => $request->exam_type_id,
               "exam_year" => $request->exam_year,
               "student_id" => $request->student_id,
               "regularity" => $regularity,
               "roll" => $request->roll,
               "master_class_id" => $request->master_class_id,
               "group_class_id" => $request->group_class_id,
               "shift" => $request->shift,
               "section" => $request->section,
               "subject_id" => $request->subject_id[$key],
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
               "grand_total_mark"=> $grand_total_mark,
               ];
    }

    protected function create_result_validation($request){
        $this->validate($request,[
          'exam_type_id'=>'required',
          'exam_year'=>'required',
          'student_id'=>['required',new ResultEntryCheck($request->only('exam_type_id','exam_year'))],
          'roll'=>'required',
        ]);
    }



    public function searchForEdit()
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $exams = $this->getExams();
        $years = $this->exam_year();
        $classes = $this->getClasses();
        return view('backEnd.results.search_edit',compact('exams','years', 'classes'));
    }

    public function edit(Request $request)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }

        $result = Result::with(['group_class'])->where($request->except('_token'))->first();
        if($result){
           $students= Student::with('user')->where([
                   'master_class_id'=>$result->master_class_id,
                   'group'=>$result->group_class->name,
                   'section'=>$result->section,
                   'shift'=>$result->shift,
                   'school_id'=>Auth::getSchool()
               ])->get();
           $subjects = Subject::where([
               'master_class_id'=>$result->student->master_class_id,
               'school_id'=>Auth::getSchool(),
               'group_class_id'=>$result->group_class_id,
           ])->get();
           $classes =$this->getClasses();
           $group_classes =GroupClass::all();
           $units =$this->getUnits();
           $group_class=GroupClass::where('id',$request->group_class_id)->select('name')->first();
           $exam_types = ExamType::all();
           return view('backEnd.results.edit',compact('subjects','classes', 'group_classes', 'units', 'group_class', 'exam_types','result','students'));
        }else{
          return $this->returnWithError('ফলাফল খুজে পাওয়া যায়নি..!');
        }

    }

    public function update(Request $request, $id)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $this->update_result_validation($request,$id);
        $grand_total_mark=$this->grand_total_mark_procesing($request);
        foreach ($request->subject_name as $key => $subject) {
          if($request->subject_status[$key]==null&&$request->result_id[$key]!=null){
            Result::where([
              'id'=>$request->result_id[$key],
              'school_id'=>Auth::getSchool(),
            ])->forceDelete();
          }
        }

        foreach ($request->subject_name as $key => $subject) {
          if($request->subject_status[$key]!=null){
             $check_mark = $this->check_mark_proccess($key,$request);
             $total=$this->per_subjet_sub_total_mark($check_mark);
             $data=$this->data_proccess($request,$subject,$key,$total,$grand_total_mark);
              $responce=Result::where([
               'school_id'=>Auth::getSchool(),
               'student_id'=>$request->student_id,
               'id'=>$request->result_id[$key],
               'subject_id'=>$request->subject_id[$key],
              ])->first();
              if($responce){
                $responce->update($data);
              }else{
                Result::create($data);
              }
            }
        }

        $this->returnWithSuccess('ফলাফল সফলভাবে আপডেট করা হয়েছে ।');
        $data_check['exam_year']=$request->exam_year;
        $data_check['exam_type_id']=$request->exam_type_id;
        $data_check['student_id']=$request->student_id;
        session()->put('data_check',$data_check);
        return redirect('result/edit');
    }

    protected function update_result_validation($request,$id){
        $this->validate($request,[
          'exam_type_id'=>'required',
          'exam_year'=>'required',
          'student_id'=>['required',new ResultEntryCheck($request->only('exam_type_id','exam_year'),$id)],
          'roll'=>'required',
        ]);
    }

    public function getResult(Request $request)
    {
        $this->validate($request, [
            'exam_year' => 'required',
            'exam_type_id' => 'required',
            'student_id' => 'required|min:15|max:15',
        ]);
        $student=Student::with(['user','masterClass'])->where([
          'student_id'=>$request->student_id,
          'school_id'=> Auth::getSchool()
        ])->first();
        $results=Result::with(['master_class','group_class'])->where([
            'exam_year'=>$request->exam_year,
            'exam_type_id'=>$request->exam_type_id,
            'student_id'=>$request->student_id,
            'status'=>1,
            'school_id'=> Auth::getSchool()
        ])->get();
       if(count($results)<1){
          Session::flash('errmgs', 'দুঃখিত, ফলাফল এখনো প্রকাশিত হয়নি ।');
          return redirect()->back();
        }
       $copulsary_results = collect($results)->where('subject_status','আবশ্যিক')->groupBy(function($element){
        return str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $element['subject_name']);
       });


       $optional_results = collect($results)->where('subject_status','ঐচ্ছিক')->groupBy(function($element){
        return str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $element['subject_name']);
       });
       $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
        if($results->count()){
            $exam = ExamType::where('id',$request->exam_type_id)->first();
            $q_data=$request->except('_token');
            $q_data['school_id']=Auth::getSchool();
            $ca_results=CaResult::where($q_data)->get();
            return view('backEnd.results.view', compact('results','exam','request','school','student','optional_results','copulsary_results','ca_results'));
        }

        Session::flash('errmgs', 'Opps, No result found !');
        return redirect()->back();
    }


    public function searchClassResult()
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $exams = $this->getExams();
        $years = $this->exam_year();
        $classes = $this->getClasses();
        $groups = $this->groupClasses();
        $units = $this->getUnits();

        return view('backEnd.results.class_result', compact('classes', 'years', 'exams','groups','units'));
    }
    public function getClassResult(Request $request)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $data=$this->validate($request,[
            'exam_year' => 'required',
            'exam_type_id' => 'required',
            'master_class_id' => 'required',
            'group_class_id' => 'required',
            'shift' => 'required',
            'section' => 'required'
        ]);

        $data['school_id'] = Auth::getSchool();
        $result = Result::where($data)->orderBy('grand_total_mark','desc')->get();
        $res = collect($result)->sortBy('roll')->reverse();
        $results = collect($res->reverse())->groupBy(['student_id']);
        $school=School::with('user','important_setting')->where(['id'=> Auth::getSchool()])->first();
        if ($results->count()){
            $exam = ExamType::where('id',$request->exam_type_id)->first();
            return view('backEnd.results.class_result_view', compact('results','exam','request','school'));
        }
        Session::flash('errmgs', 'Opps, No result found !');
        return redirect()->back();
    }

    public function tebulationCreate()
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $exams = $this->getExams();
        $years = $this->exam_year();
        $classes = $this->getClasses();
        $groups = GroupClass::all();
        $units = Unit::Where('school_id',Auth::getSchool())->get();

        return view('backEnd.results.tebulationCreate', compact('classes','years','exams','groups','units'));
    }
    public function getTebulationSheet(Request $request, ResultListController $resultList)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $data=$this->validate($request,[
            'exam_year' => 'required',
            'exam_type_id' => 'required',
            'master_class_id' => 'required',
            'group_class_id' => 'required',
            'shift' => 'required',
            'section' => 'required',
        ]);
        $data['school_id'] = Auth::getSchool();
        $result = Result::where($data)->orderBy('grand_total_mark','desc')->get();
        $res = collect($result)->sortBy('grand_total_mark');
        $position=[];
        if(count($res)>0){
          $position=$resultList->class_position_identify_number($request,$res);
        }
        $results = collect($res->reverse())->groupBy(['student_id']);
        $check_subjects =Result::where($data)->select(['subject_name','subject_status','subject_type','subject_id'])->get();
        $check_subjects =collect($check_subjects)->sortBy('subject_id');

        if(count($results)<1&&count($check_subjects)<1){
          return "<div style='text-align:center;margin:20% 20%;height:200px;background:red;color:#ffffff;'> <h2 style='    line-height: 200px;'> Nothing Found ! Sorry to Say, Please check your selected value. </h2> </div>";
        }
        $copulsary_subject = collect($check_subjects)->where('subject_status','আবশ্যিক')->groupBy(function($element){
         return str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়','ইসলাম','হিন্দু'], '', $element['subject_name']);
        });
        $subject_status=collect($check_subjects)->pluck('subject_status')->toArray();
        $subject_type=collect($check_subjects)->pluck('subject_type')->toArray();
        $school = School::with('user')->where('id',Auth::getSchool())->first();
        $exam=ExamType::where('id',$request->exam_type_id)->first();
        $class=MasterClass::where('id',$request->master_class_id)->first();
        $group=GroupClass::where('id',$request->group_class_id)->first();
        return view('backEnd.results.tebulationList', compact('results','school','data','exam','class','group','copulsary_subject','subject_status','subject_type','position'));
    }


    public function change_key( $array, $old_key, $new_key ) {

            if( ! array_key_exists( $old_key, $array ) )
                return $array;

            $keys = array_keys( $array );
            $keys[ array_search( $old_key, $keys ) ] = $new_key;

            return array_combine( $keys, $array );
    }

    public function toPublish()
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $years = $this->exam_year();
        $exams = $this->getExams();
        $classes = $this->getClasses();

        return view('backEnd.results.toPublish', compact('years', 'exams', 'classes'));
    }
    public function publish(Request $request)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $data=$this->validate($request,[
            'exam_year' => 'required',
            'exam_type_id' => 'required',
            'master_class_id' => 'required',
        ]);
        $data['school_id'] = Auth::getSchool();
        try {
            if ($request->unpublish){
                Result::where($data)->update(['status' =>0]);
                Session::flash('sccmgs', 'ফলাফল সফলভাবে প্রকাশিত হয়েছে !');
            }else{
              Result::where($data)->update(['status' => 1]);
              Session::flash('sccmgs', 'ফলাফল সফলভাবে প্রকাশিত হয়েছ !');
            }
            return redirect()->back();
        }catch (\Exception $e){
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !.'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Result $result)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
    }

}
