<?php

namespace App\Http\Controllers;

use App\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ResultListController;
use App\Http\Controllers\SmsSendController;
use App\Rules\MigrationClassCheck;
use App\Student;
use App\GroupClass;
use App\Unit;
use App\ExamType;
use App\Result;
use App\ImportantSetting;
use Validator;
use Carbon\Carbon;
use App\MasterClass;

class PromotionController extends Controller
{
   protected $student;
   protected $group_class;

   public function __construct()
   {
       $this->student = new Student();
       $this->group_class = new GroupClass();
   }
   public function index(){
    $classes = $this->getClasses();
      $units = $this->getUnits();
      return view('backEnd.promotion.index',compact('classes','units'));
   }
   public function menual(Request $request, ResultListController $resultList){
      $exams = $this->getExams();
      $years = $this->exam_year();
      $classes = $this->getClasses();
      $groups = $this->group_class->all();
      $units = $this->getUnits();
      $students = [];
      if($request->all()){
          $this->search_validation($request);
          $data=$request->only('master_class_id','shift','section');
          $data['group'] = GroupClass::where(['id'=>$request->group_class_id])->first()->name;
          $data['school_id'] = Auth::getSchool();
          $students=$this->student->where($data)->current()->get();
          $students=$students->sortBy('roll');
          $results=$resultList->get_students_result($request);
          $results=collect($results)->sortBy('roll');
          $class_position_numbers=[];
          if(count($results)>0){
            $class_position_numbers=$resultList->class_position_identify_number($request,$results);
          }
       }
      return view('backEnd.promotion.menual',compact('classes','units','groups','request','students','exams','years','class_position_numbers'));
   }

   protected function search_validation($request){
     return $this->validate($request,[
       'master_class_id'=>['required',new MigrationClassCheck($this->getClasses()->pluck('id')->toArray())],
       'group_class_id'=>'required',
       'shift'=>'required',
       'section'=>'required',
         'exam_year'=>'required',
         'exam_type_id'=>'required',
     ]);
   }

   public function menual_migration(Request $request, SmsSendController $sms_send){
        try {
            $all_students=json_decode($request->all_student);
            $migration_students=$request->number;
            $arr_ids = array_diff($all_students, $migration_students);
            $data=$request->only('master_class_id','shift','section');
            $data['group'] = GroupClass::where(['id'=>$request->group_class_id])->first()->name;
            $data['school_id']=Auth::getSchool();
            $success_students=$this->get_success_students($data,$migration_students);
            $fail_students=$this->get_fail_students($data,$arr_ids);
            $response=$this->update_migration_student($success_students,$fail_students,$data,$request,$sms_send);
            if(isset($response['succes'])){
               return $this->returnWithSuccess($response['succes']);
            }
            return $this->returnWithError($response['error']);
        }catch (\Exception $e) {
          return $this->returnWithError('দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
        }
   }

   protected function get_success_students($data,$migration_students){
           return Student::with('user')->where($data)->current()->whereIn('student_id',$migration_students)->get();
   }

   protected function get_fail_students($data,$arr_ids){
           return Student::with('user')->where($data)->current()->whereIn('student_id',$arr_ids)->get();
   }

   protected function update_migration_student($success_students,$fail_students,$data,$request,$sms_send){
           $school=$this->school();
           $data = json_decode($this->get_balance($school->api_key,$school->sender_id));
           if(isset($data->rate)){
             $total_message_cost = (count($success_students)+count($fail_students))*($data->rate*2);
             if($total_message_cost>$data->balance){
                $massege['error']='আপনার যথেষ্ট পরিমান ব্যালেন্স নাই...! বর্তমান ব্যালেন্স : '.$data->balance;
                return $massege;
             }
           }


           $id_card_exits=($school->service_type_id==1)? 0 : 1;

           $school_name = ($school->short_name==NULL) ? $sms_send->school_name_process($school->user->name) : $school->short_name;
           foreach ($success_students as $success_student){
               $sessions=explode('-', $success_student->session);
               if(count($sessions)>1){
                   $session=$success_student->session;
               }else{
                   $session=$success_student->session + 1;
               }

              $success_student->update([
               'master_class_id'=>$request->master_class_id + 1,
               'roll'=>$request->roll[$success_student->student_id],
               'group'=>$request->group_name[$success_student->student_id],
               'section'=>$request->section_name[$success_student->student_id],
               'session'=>$session,
               'id_card_exits'=>$id_card_exits,
               'regularity'=>'নিয়মিত'
              ]);
              if($request->sms_service=='yes'&&$school->api_key!=NULL && $school->sender_id!=NULL){
               $class=MasterClass::where('id',($request->master_class_id + 1))->first();

               $content='প্রিয় '.$success_student->user->name.' তোমার বর্তমান শ্রেণী '.$class->name.', বিভাগ '.$request->group_name[$success_student->student_id].' এবং শ্রেণী রোল : '.$request->roll[$success_student->student_id].', '.$school_name;
               $message= urlencode($content);
               $mobile_number=$sms_send->validateNumber([0=>$success_student->user->mobile]);
               $mobile_number = implode(',',$mobile_number);
               $a = $this->sms_send_by_api($school,$mobile_number,$message);
              }
           }

           foreach ($fail_students as $fail_student) {
              $fail_student->update([
               'roll'=>$request->roll[$fail_student->student_id],
               'group'=>$request->group_name[$fail_student->student_id],
               'section'=>$request->section_name[$fail_student->student_id],
               'id_card_exits'=>$id_card_exits,
               'regularity'=>'অনিয়মিত'
              ]);
              if($request->sms_service=='yes'&&$school->api_key!=NULL && $school->sender_id!=NULL){
               $class=MasterClass::where('id',$fail_student->master_class_id)->first();
               $content='প্রিয় '.$fail_student->user->name.' তোমার বর্তমান শ্রেণী '.$class->name.', বিভাগ '.$request->group_name[$fail_student->student_id].' এবং শ্রেণী রোল : '.$request->roll[$fail_student->student_id].', '.$school_name;
               $message= urlencode($content);
               $mobile_number=$sms_send->validateNumber([0=>$fail_student->user->mobile]);
               $mobile_number = implode(',',$mobile_number);
               $a = $this->sms_send_by_api($school,$mobile_number,$message);
              }
           }

           if(isset($a)){
             $massege['succes']='শ্রেণী মাইগ্রেশন সফল হয়েছে ...! মোট এস,এম,এস মূল্য : '.$total_message_cost;
           }else{
             $massege['succes']='শ্রেণী মাইগ্রেশন সফল হয়েছে...!!';
           }
           return $massege;
   }

}
