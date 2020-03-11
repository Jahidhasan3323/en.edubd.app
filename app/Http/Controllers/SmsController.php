<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SmsSendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\GroupClass;
use App\Unit;
use App\School;
use App\Staff;
use App\AbsentContent;
use App\AttenStudent;
use App\ExamType;
use App\Result;
use App\SmsReport;
use App\SmsLimit;
use App\MessageLength;
use Validator;
use Session;
use Carbon\Carbon;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $students=[];
       $classes = $this->getClasses();
       $class_groups=$this->groupClasses();
       $units=$this->getUnits();

       if($request->all()){
         $this->attendance_search_validation($request);
          $present_student_ids=$this->get_present_student_ids();
          $student_ids=$this->get_students($request);
          $ids=[];
          foreach ($student_ids as $student_id) {
            if(in_array($student_id, $present_student_ids)){
            }else{
              array_push($ids, $student_id);
            }
          }
          $students = $this->get_apsent_students($ids);
          $school=$this->school();
       }

        return view('backEnd.sms.index',compact('students','classes','class_groups','units','request','school'));
    }


    public function present_student(Request $request)
    {
        $ids=$this->get_present_student_ids();
        $students = $this->get_present_students($ids);
        $school = $this->school();
        return view('backEnd.sms.present_student',compact('students','school'));
    }

    protected function attendance_search_validation($request){
        $this->validate($request,[
          'master_class_id'=>'required',
          'group'=>'required',
          'shift'=>'required',
          'section'=>'required',
        ]);
    }

// current_month_sms
    protected function get_students($request){
        $school = School::find(Auth::getSchool());
        if ($school->sms_limit==0) {
            $students=Student::where([
                    'master_class_id'=>$request->master_class_id,
                    'group'=>$request->group,
                    'shift'=>$request->shift,
                    'section'=>$request->section,
                    'school_id'=>Auth::getSchool()
                ])->select('student_id')->current()->get();
        }else {
            $students=Student::where([
                    'master_class_id'=>$request->master_class_id,
                    'group'=>$request->group,
                    'shift'=>$request->shift,
                    'section'=>$request->section,
                    'school_id'=>Auth::getSchool()
                ])->whereDate('sms_date','!=',date('Y-m-d'))->select('student_id')->current()->get();
        }
        $student_ids = [];
        foreach ($students as $key => $student) {
          array_push($student_ids, $student->student_id);
        }
        return $student_ids;
    }

    protected function get_present_student_ids(){
        $present_students=AttenStudent::where([
                'date'=>Carbon::now()->format('d-m-Y'),
                'school_id'=>Auth::getSchool()
            ])->select('student_id')->get();
        $present_student_ids = [];
        foreach ($present_students as $key => $present_student) {
          array_push($present_student_ids, $present_student->student_id);
        }
        return $present_student_ids;
    }
    protected function get_apsent_students($ids){
        return Student::with('user')->where([
                        'school_id'=>Auth::getSchool()
                    ])->whereIn('student_id',$ids)->current()->get();
    }
    protected function get_present_students($ids){
        return Student::with('user')->where([
                        'school_id'=>Auth::getSchool()
                    ])->whereIn('student_id',$ids)->current()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SmsSendController $sms_send)
    {
        $classes = $this->getClasses();
        $school=$this->school();
        $extra_length = ($school->short_name?strlen($school->short_name):strlen($sms_send->school_name_process($school->user->name)))+16;
        $max_len = MessageLength::where([
            "school_id" => Auth::getSchool()
        ])->first();
        $max_len = $max_len?$max_len->notification-$extra_length:'230';
        return view('backEnd.sms.notice',compact('classes','max_len'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SmsSendController $sms_send)
    {
        if(!$request->number){
             return $this->returnWithError('দুঃখিত, কমপক্ষে ১ জন শিক্ষার্থী নির্বাচন করুন !');
        }
        $mobile_number=$sms_send->send_notification_for_absend($request->number);
        try {
             $message=AbsentContent::where('school_id',Auth::getSchool())->select('student_absent_content')->first();
             if($message){
              $school=$this->school();
              $school_name=($school==NULL) ? $sms_send->school_name_process($school->user->name) : $school->short_name;
              $content=$message->student_absent_content.' '.$school_name;
              $message= urlencode($content);
              $a = $this->sms_send_by_api($school,$mobile_number,$message);
              return $this->returnWithSuccess('SMS : '.$a.'!');
             }else{
              return $this->returnWithError('অনুগ্রহ করে নোটিফিকেশন কনটেন্ট নির্বাচন করুন !');
             }

         } catch (\Exception $e) {
             return $this->returnWithError('দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
         }
    }

    public function store_present_student(Request $request, SmsSendController $sms_send)
    {
        if(!$request->number){
             return $this->returnWithError('দুঃখিত, কমপক্ষে ১ জন শিক্ষার্থী নির্বাচন করুন !');
        }
        $mobile_number=$sms_send->send_notification_for_present($request->number);
        try {
             $message=AbsentContent::where('school_id',Auth::getSchool())->select('student_present_content')->first();
             if($message){
              $school=$this->school();
              $school_name=($school==NULL) ? $sms_send->school_name_process(Auth::user()->name) : $school->short_name;
              $content=$message->student_present_content.' '.$school_name;
              $message= urlencode($content);
              $school=$this->school();
              if(count($mobile_number)>100){
               $mobile_numbers=array_chunk($mobile_number,100);
               foreach ($mobile_numbers as $key=>$mobile_number) {
                 $mobile_number=implode(',',$mobile_number);
                 $url_AllNumber = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
                 $a = $this->send_sms_by_curl($url_AllNumber);
               }
              }else{
                 $mobile_number=implode(',',$mobile_number);
                 $url_AllNumber = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
                 $a = $this->send_sms_by_curl($url_AllNumber);
              }

              return $this->returnWithSuccess('SMS : '.$a.'!');
             }else{
              return $this->returnWithError('অনুগ্রহ করে নোটিফিকেশন কনটেন্ট নির্বাচন করুন !');
             }

         } catch (\Exception $e) {
             return $this->returnWithError('দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
         }
    }


    public function contentCreate()
    {
        $content=AbsentContent::where('school_id', Auth::getSchool())->first();
        return view('backEnd.sms.absent_content',compact('content'));
    }


    public function contentStore(Request $request)
    {
        if(!$request->student_absent_content){
          return $this->returnWithSuccess('অনুগ্রহ করে নিচের ফিল্ডগুলো পূরণ করুন !');
        }
        try {
            $data['student_absent_content']=$request->student_absent_content;
            $data['student_present_content']=$request->student_present_content;
            $data['school_id']=Auth::getSchool();
            $content=AbsentContent::where('school_id', Auth::getSchool())->first();
            if($content){
               AbsentContent::where('school_id',Auth::getSchool())->update($data);
            }else{
              AbsentContent::insert($data);
            }
            return $this->returnWithSuccess('কনটেন্ট সেটিং সফল হয়েছে !');
        } catch (\Exception $e) {
            return $this->returnWithError('দুঃখিত, সমস্যা হয়েছে !');
        }
    }


    public function send(Request $request,  SmsSendController $sms_send)
    {
        $school=$this->school();
        $extra_length = ($school->short_name?strlen($school->short_name):strlen($sms_send->school_name_process($school->user->name)))+17;
        $max_len = MessageLength::where([
            "school_id" => Auth::getSchool()
        ])->first();
        $max_len = $max_len?$max_len->notification-$extra_length:'250';
        if (strlen($request->message) > $max_len) {
            return $this->returnWithError('দুঃখিত, কমপক্ষে ১ জন শিক্ষার্থী নির্বাচন করুন !');
        }

      if(!$request->message){
         $this->Validate($request, [
                  'message' => 'required'
         ]);
      }
      $this->validation_input($request);
      $sms_report = SmsReport::where('school_id', Auth::getSchool())->where('sms_type', 1)->whereYear('date', date('Y'))->whereMonth('date', date('m'))->count();
      $sms_limit = SmsLimit::where('school_id', $school->id)->first();
      $sms_limit = $sms_limit?$sms_limit->notification:'0';
      $school_name=($school==NULL) ? $sms_send->school_name_process(Auth::user()->name) : $school->short_name;
      $content=$request->message.' '.$school_name;
      $message= urlencode($content);
      if($school->service_type_id==1){
         $data['id_card_exits'] = 1;
      }
      $data['school_id']=Auth::getSchool();
          if($request->to_class){
               if($request->to_class[0]=="all"){
                   $students=Student::with('user')->where($data)->current()->get();
                }else{
                   $students=Student::with('user')->where($data)->whereIn('master_class_id',$request->to_class)->current()->get();
                }

               if($request->sub_to==["Guardian","Student"]){
                  foreach ($students as $student) {
                   $number1[] = ($student->f_mobile_no==NULL)?($student->m_mobile_no==NULL?$student->guardian_mobile:$student->m_mobile_no):$student->f_mobile_no;
                  }
                  foreach ($students as $student) {
                   $number2[] = $student->user->mobile;
                  }
                  $numbers=array_merge($number1,$number2);
                  $mobile_number=$sms_send->send_for_student($numbers);
               }elseif($request->sub_to==["Guardian"]){
                  foreach ($students as $student) {
                   $numbers[] = ($student->f_mobile_no==NULL)?($student->m_mobile_no==NULL?$student->guardian_mobile:$student->m_mobile_no):$student->f_mobile_no;
                  }
                  $mobile_number=$sms_send->send_for_student($numbers);
               }else{
                  foreach ($students as $student) {
                   $numbers[] = $student->user->mobile;
                  }
                  $mobile_number=$sms_send->send_for_student($numbers);
               }

               if(count($mobile_number)>50){
                $mobile_numbers=array_chunk($mobile_number,50);
                foreach ($mobile_numbers as $key=>$mobile_number) {
                  $mobile_number=implode(',',$mobile_number);
                  $url_AllNumber = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
                  if ($school->sms_service==0) {
                      $a = $this->send_sms_by_curl($url_AllNumber);
                  }else {
                      if ($sms_report < $sms_limit && urldecode(strlen($message)) < 305) {
                          $a = $this->send_sms_by_curl($url_AllNumber);
                      }else {
                          return json_encode(["status"=>"আপনার নির্ধারিত এস,এম,এসের পরিমান শেষ হয়েছে ।","error"=>"1"]);
                      }
                  }

                }

               }else {
                 $mobile_number=implode(',',$mobile_number);
                 $url_AllNumber = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
                 if ($school->sms_service==0) {
                     $a = $this->send_sms_by_curl($url_AllNumber);
                 }else {
                     if ($sms_report < $sms_limit && urldecode(strlen($message)) < 305) {
                         $a = $this->send_sms_by_curl($url_AllNumber);
                     }else {
                         return json_encode(["status"=>"আপনার নির্ধারিত এস,এম,এসের পরিমান শেষ হয়েছে ।","error"=>"1"]);
                     }
                 }
               }
               $success = json_decode($a,true);
               if ($success['error']==0) {
                   $sms = new SmsReport;
                   $sms->sms_type = 1;
                   $sms->date = now();
                   $sms->save();
               }
               Session::flash('sccmgs', 'SMS : '.$a.'!');
               return redirect()->back();
          }

          if($request->to_teacher){
               $teachers=Staff::with('user')->where('school_id',Auth::getSchool())->current()->get();
               $mobile_number=$sms_send->send_for_teacher($teachers);
             if(count($mobile_number)>50){
                  $mobile_numbers=array_chunk($mobile_number,50);
                  foreach ($mobile_numbers as $key=>$mobile_number) {
                    $mobile_number=implode(',',$mobile_number);
                    $url_AllNumber = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
                    $a = $this->send_sms_by_curl($url_AllNumber);
                  }
             }else {
                   $mobile_number=implode(',',$mobile_number);
                   $url_AllNumber = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
                   $a = $this->send_sms_by_curl($url_AllNumber);
             }
             Session::flash('sccmgs', 'SMS : '.$a.'!');
             return redirect()->back();

          }
    }

    protected function validation_input($request){
      if($request->to_teacher){
         $this->Validate($request, [
                  'to_teacher' => 'required',
         ]);
      }

      if($request->to_class){
         $this->Validate($request, [
                  'to_class' => 'required',
                  'sub_to' => 'required',
         ]);
      }
      if(!$request->to_class && !$request->to_teacher){
         $this->Validate($request, [
                  'to_class' => 'required',
                  'to_teacher' => 'required',
         ]);
      }

    }

    public function number_collection(Request $request,SmsSendController $sms_send){
         $phone_number='';$numbers=[]; $number1=[]; $number2=[];
         if($request->all()){
            $this->validation_input($request);
            $school = $this->school();
            if($school->service_type_id==1){
               $data['id_card_exits']=1;
            }
            $data['school_id']=Auth::getSchool();
            if($request->to_class){
                 if($request->to_class[0]=="all"){
                     $students=Student::with('user')->where($data)->current()->get();
                  }else{
                     $students=Student::with('user')->where($data)->whereIn('master_class_id',$request->to_class)->current()->get();
                  }

                 if($request->sub_to==["Guardian","Student"]){
                    foreach ($students as $student) {
                     $number1[] = ($student->f_mobile_no==NULL)?($student->m_mobile_no==NULL?$student->guardian_mobile:$student->m_mobile_no):$student->f_mobile_no;
                    }
                    foreach ($students as $student) {
                     $number2[] = $student->user->mobile;
                    }
                    $numbers=array_merge($number1,$number2);
                    $mobile_number=$sms_send->send_for_student($numbers);
                 }elseif($request->sub_to==["Guardian"]){
                    foreach ($students as $student) {
                     $numbers[] = ($student->f_mobile_no==NULL)?($student->m_mobile_no==NULL?$student->guardian_mobile:$student->m_mobile_no):$student->f_mobile_no;
                    }
                    $mobile_number=$sms_send->send_for_student($numbers);
                 }else{
                    foreach ($students as $student) {
                     $numbers[] = $student->user->mobile;
                    }
                    $mobile_number=$sms_send->send_for_student($numbers);
                 }
            }

            if($request->to_teacher){
                 $teachers=Staff::with('user')->where('school_id',Auth::getSchool())->current()->get();
                 $mobile_number=$sms_send->send_for_teacher($teachers);
            }

            $phone_number = implode(',',$mobile_number);

         }
         $classes = $this->getClasses();
         return view('backEnd.sms.number_collection',compact('classes','phone_number'));
    }

    public function result(Request $request){
      $results=[];
      $exam_years = $this->exam_year();
      $classes = $this->getClasses();
      $class_groups=$this->groupClasses();
      $units=$this->getUnits();
      $exam_types=ExamType::all();
      if($request->all()){
        $this->result_request_validation($request);
        $results=$this->get_students_result($request);
        $school=$this->school();
      }

      return view('backEnd.sms.result_send',compact('results','exam_years','classes','class_groups','units','request','exam_types','school'));
    }
    protected function result_request_validation($request){
            $this->validate($request,[
              'exam_year'=>'required',
              'master_class_id'=>'required',
              'group'=>'required',
              'section'=>'required',
              'shift' => 'required',
              'exam_type_id'=>'required'
            ]);
    }

    protected function get_students_result($request){
      $results = Result::with('student','student.masterClass')->where([
                 'exam_year'=>$request->exam_year,
                 'master_class_id'=>$request->master_class_id,
                 'group_class_id'=>GroupClass::where('name',$request->group)->select('id')->first()->id,
                 'shift'=>$request->shift,
                 'section'=>$request->section,
                 'exam_type_id'=>$request->exam_type_id,
                 'status'=>1,
                 'school_id'=>Auth::getSchool(),
                ])->groupBy('student_id')->get();
      return $results;
    }

    public function result_send(Request $request, SmsSendController $sms_send){
        if(!$request->students){
             return $this->returnWithError('দুঃখিত, কমপক্ষে ১ জন শিক্ষার্থী নির্বাচন করুন !');
        }
        foreach ($request->students as $student) {
          $array=explode(',', $student);
          if($array[0]!=""){
            $school=$this->school();
            $sms_limit = SmsLimit::where('school_id', $school->id)->first();
            $sms_limit = $sms_limit?$sms_limit->result:'0';
            $school_name = ($school->short_name==NULL) ? $sms_send->school_name_process(Auth::user()->name) : $school->short_name;
            $content='শিক্ষার্থী : '.$array[1].', শ্রেণী : '.$array[2].', মোট নম্বর : '.$array[3].', প্রাপ্ত জিপিএ : '.$array[4].', '.$school_name;
            $message= urlencode($content);
            $mobile_number=implode(',',$sms_send->validateNumber([$array[0]]));
            $url_AllNumber = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
            $sms_report = SmsReport::where('school_id', Auth::getSchool())->where('sms_type', 2)->where('student_id',$array[5])->whereYear('date', date('Y'))->count();
            if ($school->sms_service==0) {
                $a = $this->send_sms_by_curl($url_AllNumber);
            }else {
                if ($sms_report < $sms_limit) {
                    $a = $this->send_sms_by_curl($url_AllNumber);
                }else {
                    return json_encode(["status"=>"আপনার নির্ধারিত এস,এম,এসের পরিমান শেষ হয়েছে ।","error"=>"1"]);
                }
            }
            $success = json_decode($a,true);
            if ($success['error']==0) {
                $sms = new SmsReport;
                $sms->sms_type = 2;
                $sms->student_id = $array[5];
                $sms->date = now();
                $sms->save();
            }
          }
        }
        return $this->returnWithSuccess('SMS : '.$a.'!');
    }


}
