<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\GroupClass;
use App\Unit;
use App\ExamType;
use App\Result;
use App\ImportantSetting;
use Validator;
use Session;
use Carbon\Carbon;

class ResultListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(Request $request){
      $results=[];
      $exam_years = $this->exam_year();
      $classes = $this->getClasses();
      $class_groups=$this->groupClasses();
      $units=Unit::where(['school_id'=> Auth::getSchool()])->get();
      $exam_types=ExamType::all();
      $active_path="all";
      if($request->all()){
        $active_path=$this->active_path($request);
        $reqiered_data=$this->result_validation_data($request);
        $this->result_request_validation($request,$reqiered_data);
        $results=$this->get_students_result($request);
        $results=collect($results)->sortBy('roll');
        if(count($results)==0){
          return $this->returnWithError('No result found...!');
        }
        $class_position_numbers=$this->class_position_identify_number($request,$results);
        $class_position_numbers['total_numbers']=null;
      }
      $school = $this->school();
       return view('backEnd.resultList.index',compact('results','exam_years','classes','class_groups','units','request','exam_types','class_position_numbers','active_path','school'));
    }



    public function class_position_identify_number($request,$results=NULL){
     
       $success_position_numbers=[];
       $fail_position_numbers=[];
        $imp_setting=ImportantSetting::where('school_id',Auth::getSchool())->select('class_position_identify')->first();
        if(isset($imp_setting->class_position_identify)&&$imp_setting->class_position_identify&&($request->exam_type_id==1||$request->exam_type_id==4)){
           foreach (explode('|', $imp_setting->class_position_identify) as $key => $exam_type_id) {
                $q_data=$request->except('_token');
                $q_data['status']=1;
                $q_data['school_id']=Auth::getSchool();
               $results=Result::with('exam_type','student','student.masterClass','student.user')
                 ->where($q_data)
                 ->groupBy('student_id')->get();
               if(count($results)>0){
                 $get_data=$this->get_position($results, true);
                 $all_gpa[]=$get_data['gpa'];
                 $all_gpa_total_mark[]=$get_data['gpa_total_mark'];
               }
           }
           $total_numbers=[];
           foreach ($all_gpa as $gpa) {
             foreach ($gpa as $key => $value) {
               if(array_key_exists($key, $total_numbers)){
                $total_numbers[$key]=($value=='0.00')?($total_numbers[$key] * $value):($total_numbers[$key] + $value);
               }else{
                 $total_numbers[$key]="$value";  
               }
             }
           }
           $total_grand_marks=[];
           foreach ($all_gpa_total_mark as $gpa_total_mark) {
             foreach ($gpa_total_mark as $key => $value) {
               if(array_key_exists($key, $total_grand_marks)){
                $total_grand_marks[$key]=$total_grand_marks[$key] + $value;
               }else{
                 $total_grand_marks[$key]="$value";  
               }
             }
           }
          
           foreach ($total_grand_marks as $key => $total_grand_mark) {
             if($total_numbers[$key]>0){
               $success_position_numbers[$key]=$total_grand_mark;
             }else{
               $fail_position_numbers[$key]=$total_grand_mark;
             }
           }


           if(count($success_position_numbers)>0){
             arsort($success_position_numbers,true);
           }
           if(count($fail_position_numbers)>0){
             arsort($fail_position_numbers,true);
           }
           $success_numbers=[];
           $fail_numbers=[];
           foreach ($success_position_numbers as $key=>$success_position_number) {
               $success_numbers[]=$key.''.$success_position_number;
           }
           $serial=count($success_numbers);
           foreach ($fail_position_numbers as $key=>$fail_position_number) {
               $fail_numbers[$serial++]=$key.''.$fail_position_number;
           }
           $data['success_position_numbers']=$success_position_numbers;
           $data['fail_position_numbers']=$fail_position_numbers;
           $data['success_numbers']=$success_numbers;
           $data['fail_numbers']=$fail_numbers;
           $data['gpa']=$get_data['gpa'];
           $data['multi_base']=true;
           return $data;
          
        }else{
           $data=$this->get_position($results, false);
           $data['multi_base']=false;
           return $data;
        }

    }

    public function get_position($results, $multi_base){
      $s=1; $total_student=$results;
      
     $success_position_numbers=[];
     $fail_position_numbers=[];

      foreach($results as $res){
               $student_results=Result::where([
                'school_id'=>Auth::getSchool(),
                'student_id'=>$res->student_id,
                'exam_year'=>$res->exam_year,
                'exam_type_id'=>$res->exam_type_id,
              ])->get();

               $copulsary_results = collect($student_results)->groupBy(function($element){
                return str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $element['subject_name']);
               });
                $i=1;
                foreach ($copulsary_results as $key=>$results) {
                   $subjects[$i++]=$results;
                }
                foreach ($subjects as $key => $subject){
                    if(count($subject)>1){
                    $name=str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $subject[0]->subject_name);
                    $ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark)+
                            ($subject[1]->ca_mark=='--'?0:$subject[1]->ca_mark);
                    $cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark)+
                            ($subject[1]->cr_mark=='--'?0:$subject[1]->cr_mark);
                    $mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark)+
                            ($subject[1]->mcq_mark=='--'?0:$subject[1]->mcq_mark);
                    $pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark)+
                            ($subject[1]->pr_mark=='--'?0:$subject[1]->pr_mark);

                    $ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark)+
                            ($subject[1]->ca_pass_mark=='--'?0:$subject[1]->ca_pass_mark);
                    $cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark)+
                            ($subject[1]->cr_pass_mark=='--'?0:$subject[1]->cr_pass_mark);
                    $mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark)+
                            ($subject[1]->mcq_pass_mark=='--'?0:$subject[1]->mcq_pass_mark);
                    $pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark)+
                            ($subject[1]->pr_pass_mark=='--'?0:$subject[1]->pr_pass_mark);
                    }else{
                     $name=str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $subject[0]->subject_name);
                     $ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark);
                     $cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark);
                     $mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark);
                     $pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark);

                     $ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark);
                     $cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark);
                     $mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark);
                     $pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark);
                    }
                }

                 $i=1;

               $total_gpa_otional=[];
                $sub_totals=$copulsary_results->map(function($row){
                 return $row->sum('sub_total');
                });
                $total_marks=$copulsary_results->map(function($row){
                 return $row->sum('total_mark');
                });
                foreach($copulsary_results as $subject=>$result){
                 if($ca_mark[$subject]>=$ca_pass_mark[$subject]&&$cr_mark[$subject]>=$cr_pass_mark[$subject]&&$mcq_mark[$subject]>=$mcq_pass_mark[$subject]&&$pr_mark>$pr_pass_mark[$subject]){
                   $sub_total=$sub_totals[$subject];
                   $total_mark=$total_marks[$subject];
                   if($result[0]['subject_status']=='আবশ্যিক'){
                    $total_gpa_compulsary[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa'];
                   }else{
                    $total_gpa_otional[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa']; 
                   }
                 }else{
                   if($result[0]['subject_status']=='আবশ্যিক'){
                    $total_gpa_compulsary[$subject]=0;
                   }else{
                    $total_gpa_otional[$subject]=0; 
                   }
                 }
                }

                $op_gpa=(array_sum($total_gpa_otional)>2)?(array_sum($total_gpa_otional)-2):0;
                $total_gpa=(array_sum($total_gpa_compulsary)+$op_gpa)/count($total_gpa_compulsary);
                $total_gpa=($total_gpa>5)?5:$total_gpa;
                $total_gpa=number_format($total_gpa, 2, '.', '');
                 if(array_product($total_gpa_compulsary)>0){
                     $data['gpa'][$res->student_id]=$total_gpa;
                     $data['gpa_total_mark'][$res->student_id]=$total_gpa+$res->grand_total_mark;
                     $success_position_numbers[$res->student_id]=$total_gpa+$res->grand_total_mark;
                 }else{
                     $data['gpa'][$res->student_id]='0.00';
                     $data['gpa_total_mark'][$res->student_id]=$res->grand_total_mark;
                     $fail_position_numbers[$res->student_id]=$res->grand_total_mark;
                 }
               
               $total_gpa_optional=[]; 
               $total_gpa_compulsary=[]; 
      }
        if($multi_base==true){
          return $data;
        }
        if(count($success_position_numbers)>0){
           arsort($success_position_numbers,true);
        }
        if(count($fail_position_numbers)>0){
           arsort($fail_position_numbers,true);
        }
       $success_numbers=[];
       $fail_numbers=[];
       foreach ($success_position_numbers as $key=>$success_position_number) {
           $success_numbers[]=$key.''.$success_position_number;
       }
       $serial=count($success_numbers);
       foreach ($fail_position_numbers as $key=>$fail_position_number) {
           $fail_numbers[$serial++]=$key.''.$fail_position_number;
       }
       $data['success_numbers']=$success_numbers;
       $data['fail_numbers']=$fail_numbers;
       return $data;
    }

    protected function active_path($request){

           if(count($request->all())==5&&isset($request->group_class_id)){
            return "group_based";
           }

           if(count($request->all())==5&&isset($request->section)){
             return "section_based";
           }

           if(count($request->all())==4){
             return "class_based";
           }
            return "all";
    }

    protected function result_validation_data($request){

           if(count($request->all())==5&&isset($request->group_class_id)){
            return [
                     'exam_year'=>'required',
                     'master_class_id'=>'required',
                     'group_class_id'=>'required',
                     'exam_type_id'=>'required'
                   ];
           }

           if(count($request->all())==5&&isset($request->section)){
            return [
                     'exam_year'=>'required',
                     'master_class_id'=>'required',
                     'section' => 'required',
                     'exam_type_id'=>'required'
                   ];
           }

           if(count($request->all())==4){
            return [
                     'exam_year'=>'required',
                     'master_class_id'=>'required',
                     'exam_type_id'=>'required'
                   ];
           }
            return [
                    'exam_year'=>'required',
                    'master_class_id'=>'required',
                    'group_class_id'=>'required',
                    'section'=>'required',
                    'shift' => 'required',
                    'exam_type_id'=>'required'
                   ];
    }

    protected function result_request_validation($request,$reqiered_data){
        $this->validate($request,$reqiered_data);
    }


    public function get_students_result($request){
      $q_data=$request->except('_token');
      $q_data['status']=1;
      $q_data['school_id']=Auth::getSchool();
      $results = Result::with('exam_type','student','student.masterClass','student.user')->where($q_data)->groupBy('student_id')->get();
      return $results;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function print_view(Request $request)
    {
        $results = json_decode($request->results);
        $class_position_numbers = json_decode($request->class_position_numbers,true);
        $exam_type_id = $request->exam_type_id;
        $results=collect($results)->sortBy('roll');
        $school = $this->school();
        return view('backEnd.resultList.print_view',compact('results','school','class_position_numbers','exam_type_id','request'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
