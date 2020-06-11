<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsSendController;
use Illuminate\Http\Request;
use App\School;
use App\Student;
use App\Teacher;
use App\Staff;
use App\Commitee;
use App\User;
use App\DateLanguage;
use App\Notice;
use App\WmGallery;
use App\WmImportantLink;
use App\WmImportantLinksCategory;
use App\WmImportantLinksRoot;
use App\WmSpeech;
use App\WmSlider;
use App\WmSchool;
use App\WmGeneralText;
use App\WmGalleryCategory;
use App\Holiday;
use App\ImportantFile;
use App\Care;
use App\OnlineAdmissionApplication;
use App\OnlineAdmissionAccademicInfo;
use App\OnlineAdmissionApplicationSubject;
use App\OnlineAdmission;
use App\MasterClass;
use Validator;
use DB;
class SchoolController extends Controller
{

    public function get_serial(Request $request){
       $url1='https://'.$request->website;
        $url2='https://www.'.$request->website;
        $url3='http://'.$request->website;
        $url4='http://www.'.$request->website;
        $url5='http://www.'.$request->website.'/';
        $url6='http://'.$request->website.'/';
        $url7='https://www.'.$request->website.'/';
        $url8='https://'.$request->website.'/';

        $serial=School::where('website',$url1)
        ->orWhere('website',$url2)
        ->orWhere('website',$url3)
        ->orWhere('website',$url4)
        ->orWhere('website',$url5)
        ->orWhere('website',$url6)
        ->orWhere('website',$url7)
        ->orWhere('website',$url8)
        ->orWhere('website',$request->website)
        ->value('serial_no');
        return $this->sendResponse($serial, 'School Serial retrieved successfully.');
    }
    /**
     * return a school information api response.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $school=School::with('user')->where('serial_no',$request->serial_no)->first();
       return $this->sendResponse($school, 'School retrieved successfully.');  
    }
    public function wm_schools(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $wm_schools=WmSchool::where('school_id',$school->id)->first();
       return $this->sendResponse($wm_schools, 'School website data retrieved successfully.');  
    }
    public function date_laguage()
    {
        
       $date_language=DateLanguage::get();
       return $this->sendResponse($date_language, 'Date language retrieved successfully.');  
    }

    public function notice(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $notice=Notice::where(['school_id'=>$school->id,'status'=>1])->orderby('id','DESC')->limit(20)->get();
       return $this->sendResponse($notice, 'Notice retrieved successfully.');  
    }
    
    public function image_home(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $image_home=WmGallery::where(['school_id'=>$school->id,'wm_gallery_category_id'=>1])->orderby('id','DESC')->limit(15)->get();
       return $this->sendResponse($image_home, 'Image retrieved successfully.');  
    }
    
    public function important_link_header(Request $request)
    {
      $school=School::where('serial_no',$request->serial_no)->first();

      $important_link_header=WmImportantLinksRoot::with('important_links_category_root')->where(['school_type_id'=>$school->school_type_id,'header_status'=>1])->orderby('id','DESC')->get();
       return $this->sendResponse($important_link_header, 'Important link header retrieved successfully.');  
    }
    public function important_link(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $important_link=WmImportantLinksCategory::with('important_links')->where(['school_id'=>$school->id])->orderby('id','DESC')->limit(8)->get();
       return $this->sendResponse($important_link, 'Important link retrieved successfully.');  
    }
    public function important_file(Request $request)
    {
        $important_files=ImportantFile::where('type',2)->orderBy('id','DESC')->limit(5)->get();
       return $this->sendResponse($important_files, 'Important file retrieved successfully.');  
    }

    public function student_count(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $data['teacher'] = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->join('designations', 'staff.designation_id','=','designations.id')
                        ->where(['users.group_id'=> 3,'staff.school_id'=>$school->id])
                        ->select('users.name','users.email','users.mobile','staff.id','designations.name as designation','staff.staff_id','staff.joining_date','staff.edu_qulif')
                        ->whereNull('staff.deleted_at')
                        ->count('staff.id');
         $data['staff'] = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->join('designations', 'staff.designation_id','=','designations.id')
                        ->where(['staff.school_id'=>$school->id])
                        ->where('users.group_id','!=', 3)
                        ->select('users.name','users.email','users.mobile','staff.id','designations.name as designation','staff.staff_id','staff.joining_date','staff.edu_qulif')
                        ->whereNull('staff.deleted_at')
                        ->count('staff.id');
        $data['male']=Student::where(['school_id'=>$school->id,'gender'=>'male'])->current()->count();
        $data['female']=Student::where(['school_id'=>$school->id,'gender'=>'female'])->current()->count();
       return $this->sendResponse($data, 'Number of student retrieved successfully.');  
    }

    public function slider(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $slider=WmSlider::where(['school_id'=>$school->id])->orderby('position','ASC')->get();
       return $this->sendResponse($slider, 'Slider retrieved successfully.');  
    }


    public function home_data(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $data['website']=WmSchool::where(['school_id'=>$school->id])->first();
        $data['academic_history']=WmSpeech::where(['school_id'=>$school->id,'type_id'=>3])->first();
        $data['chairman_speech']=WmSpeech::where(['school_id'=>$school->id,'type_id'=>1])->first();
        $data['pricipal_speech']=WmSpeech::where(['school_id'=>$school->id,'type_id'=>2])->first();
        $data['present_student_speech']=WmSpeech::where(['school_id'=>$school->id,'type_id'=>4])->orderby('position','ASC')->get();
        $data['old_student_speech']=WmSpeech::where(['school_id'=>$school->id,'type_id'=>5])->orderby('position','ASC')->get();
        $data['alumni_speech']=WmSpeech::where(['school_id'=>$school->id,'type_id'=>6])->orderby('position','ASC')->get();

        $data['commitee']=Commitee::with('user')
               ->where('school_id',$school->id)
               ->current()
               ->get();
        $data['old_commitee']=Commitee::with('user')
               ->where('school_id',$school->id)
               ->old()
               ->get();
        $data['teachers'] = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->join('designations', 'staff.designation_id','=','designations.id')
                        ->where(['staff.school_id'=>$school->id])
                        ->select('users.name','staff.photo','designations.name as designation','staff.birthday','staff.id')
                        ->whereNull('staff.deleted_at')
                        ->get();
        $data['old_teachers'] = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->join('designations', 'staff.designation_id','=','designations.id')
                        ->where(['staff.school_id'=>$school->id])
                        ->whereNotNull('staff.deleted_at')
                        ->select('users.name','staff.photo','staff.joining_date','staff.retirement_date','staff.id')
                        ->get();
        $data['students']=Student::with('user','masterClass')
                           ->where('school_id',$school->id)
                           ->WhereIn('session',[
                            date('Y')-1,
                            date('Y'),
                            (date('Y')-1).'-'.date('Y'),
                            date('Y').'-'.(date('Y')-1),
                            date('Y').'-'.(date('Y')+1),
                            (date('Y')+1).'-'.date('Y'),
                            ])
                           ->selectRaw(
                               '*,count(student_id) as total'
                            )
                           ->groupBy(['master_class_id','group','section','shift'])
                           ->current()
                           ->get();
       return $this->sendResponse($data, 'Home data retrieved successfully.');  
    }

    public function information_details(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $information_details=WmSpeech::where(['school_id'=>$school->id,'id'=>$request->id])->first();
       return $this->sendResponse($information_details, 'Information details retrieved successfully.');  
    }

    public function notice_details(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $notice_details=Notice::where(['school_id'=>$school->id,'id'=>$request->id])->first();
       return $this->sendResponse($notice_details, 'Notice details retrieved successfully.');  
    }

    public function accademic_information(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $accademic_information=WmSpeech::where(['school_id'=>$school->id,'type_id'=>3])->first();
       return $this->sendResponse($accademic_information, 'School information retrieved successfully.');  
    }
    public function admission_information(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $admission_information=WmGeneralText::where(['school_id'=>$school->id,'wm_general_text_type_id'=>3])->first();
       return $this->sendResponse($admission_information, 'Admission information retrieved successfully.');  
    }
    public function fee(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $fee=WmGeneralText::where(['school_id'=>$school->id,'wm_general_text_type_id'=>4])->first();
       return $this->sendResponse($fee, 'fee information retrieved successfully.');  
    }
    public function dress(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $dress=WmGeneralText::where(['school_id'=>$school->id,'wm_general_text_type_id'=>2])->first();
       return $this->sendResponse($dress, 'dress information retrieved successfully.');  
    }
    public function image_category(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $image_category=WmGalleryCategory::where(['school_id'=>$school->id,'type'=>1])->orderby('id','DESC')->get();
       return $this->sendResponse($image_category, 'image category information retrieved successfully.');  
    }
    public function video_category(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $video_category=WmGalleryCategory::where(['school_id'=>$school->id,'type'=>2])->orderby('id','DESC')->get();
       return $this->sendResponse($video_category, 'video category information retrieved successfully.');  
    }

    public function image(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $image=WmGallery::where(['school_id'=>$school->id,'type'=>1,'wm_gallery_category_id'=>$request->id])->orderby('id','DESC')->get();
       return $this->sendResponse($image, 'image   retrieved successfully.');  
    }
    public function video(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $video=WmGallery::where(['school_id'=>$school->id,'type'=>2,'wm_gallery_category_id'=>$request->id])->orderby('id','DESC')->get();
       return $this->sendResponse($video, 'video retrieved successfully.');  
    }
    public function accademic_vacation(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $data['holidays'] = Holiday::whereYear('date', '=', date('Y'))
                   ->whereIn('school_id',[$school->id,0])
                   ->groupBy(DB::raw('MONTH(date)'))
                   ->select('*', DB::raw('count(*) as total'))
                   ->get();
        $data['months'] = Array ('January','February','March','April','May','June','July','August','September','October','November','December');
       return $this->sendResponse($data, 'holidays retrieved successfully.');  
    }

    public function accademic_vacation_list(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $data['holidays'] = Holiday::whereYear('date',$request->year)->whereMonth('date',$request->month)->whereIn('school_id',[$school->id,0])->select('date')->get();
        $data['months'] = Array ('January','February','March','April','May','June','July','August','September','October','November','December');
        $data['month'] =$request->month;
        $data['year'] =$request->year;
       return $this->sendResponse($data, 'holidays retrieved successfully.');  
    }
    public function class(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $data['students'] = Student::with('masterClass')
            ->where(['school_id'=>$school->id])
            ->select(['master_class_id','group','section','shift'])
            ->selectRaw(
                'count(id) as total_student,session'
             )
            ->groupBy(['master_class_id','group','section','session','shift'])
            ->current()
            ->orderBy('id','desc')->get();
        $data['student_type']=0;
       return $this->sendResponse($data, 'class retrieved successfully.');  
    }
    public function student(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $data=['school_id'=>$school->id,
               'master_class_id'=>$request->master_class_id,
               'group'=>$request->group,
               'section'=>$request->section,
               'shift'=>$request->shift,
               'session'=>$request->session];
        $students = Student::with('user')
            ->where($data)
            ->current()
            ->orderBy('id','desc')->get();
       return $this->sendResponse($students, 'class retrieved successfully.');  
    }

   /* public function login(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
       $video=WmGallery::where(['school_id'=>$school->id,'type'=>2,'wm_gallery_category_id'=>$request->id])->orderby('id','DESC')->get();
       return $this->sendResponse($video, 'video retrieved successfully.');  
    }*/

    


    /**
     * Show student list api response.
     *
     * @return \Illuminate\Http\Response
     */
    public function students(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $students=Student::with('user','masterClass')
                           ->where('school_id',$school->id)
                           ->WhereIn('session',[
                            date('Y')-1,
                            date('Y'),
                            (date('Y')-1).'-'.date('Y'),
                            date('Y').'-'.(date('Y')-1),
                            date('Y').'-'.(date('Y')+1),
                            (date('Y')+1).'-'.date('Y'),
                            ])
                           ->selectRaw(
                               '*,count(student_id) as total'
                            )
                           ->groupBy(['master_class_id','group','section','shift'])
                           ->current()
                           ->get();

        return $this->sendResponse($students, 'Student retrieved successfully.'); 
    }


    /**
     * return a teacher list api response.
     *
     * @return \Illuminate\Http\Response
     */
    public function teachers(Request $request)
    {
       $school=School::where('serial_no',$request->serial_no)->select('id')->first();
       $teachers = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->join('designations', 'staff.designation_id','=','designations.id')
                        ->where(['users.group_id'=> 3,'staff.school_id'=>$school->id])
                        ->select('users.name','users.email','users.mobile','staff.photo','designations.name as designation','staff.staff_id','staff.joining_date','staff.edu_qulif')
                        ->whereNull('staff.deleted_at')
                        ->get();
        return $this->sendResponse($teachers, 'teachers retrieved successfully.');
    }

    /**
     * return a staff list api response.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function staff(Request $request)
    {
       $school=School::where('serial_no',$request->serial_no)->select('id')->first();
       $staff = User::join('staff', 'users.id', '=', 'staff.user_id')
                         ->join('designations', 'staff.designation_id','=','designations.id')
                         ->where('school_id',$school->id)
                         ->where('users.group_id','!=',3)
                         ->select('users.name','users.email','users.mobile','staff.photo','designations.name as designation','staff.staff_id')
                         ->get();
       return $this->sendResponse($staff, 'Staff retrieved successfully.');
    }


    /**
     * return a commitee list api response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function commitee(Request $request)
    {
       $school=School::where('serial_no',$request->serial_no)->select('id')->first();
       $commitee=Commitee::with('user')
               ->where('school_id',$school->id)
               ->current()
               ->get();
       return $this->sendResponse($commitee, 'Commitee retrieved successfully.');  
    }

    
    public function birthday(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $data['commitee']=Commitee::with('user')
               ->where('school_id',$school->id)
               ->get();
        $data['teachers'] = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->join('designations', 'staff.designation_id','=','designations.id')
                        ->where(['staff.school_id'=>$school->id])
                        ->select('users.name','staff.photo','designations.name as designation','staff.birthday','staff.id')
                        ->whereNull('staff.deleted_at')
                        ->get();
        $data['students']=Student::with('user','masterClass')
                           ->where('school_id',$school->id)
                           ->WhereIn('session',[
                            date('Y')-1,
                            date('Y'),
                            (date('Y')-1).'-'.date('Y'),
                            date('Y').'-'.(date('Y')-1),
                            date('Y').'-'.(date('Y')+1),
                            (date('Y')+1).'-'.date('Y'),
                            ])
                           ->selectRaw(
                               '*,count(student_id) as total'
                            )
                           ->groupBy(['master_class_id','group','section','shift'])
                           ->current()
                           ->get();
       
       return $this->sendResponse($data, 'Birthday data retrieved successfully.');  
    }


    public function suggetion(Request $request){
       
      $school=School::where('serial_no',$request->serial_no)->first();
      $data= $request->except('serial_no');
      $validator = Validator::make($request->all(), [
        "subject" => "required|string|max:255",
        "description" => "required",
          ]);
          if ($validator->fails()) {
              return "danger";
          }
      
        $last_problem = Care::orderBy('id','desc')->first();
          if ($last_problem) {
              $token = $last_problem->token+1;
          }else {
              $token = 1001;
          }
          $data['token'] = $token;
          $data['school_id'] = $school->id;
          $data['from'] = 2;
          Care::create($data);
          return "message";
   }
public function admission_notice(Request $request)
    {
        $school=School::where('serial_no',$request->serial_no)->first();
        $notice=Notice::where(['school_id'=>$school->id,'status'=>1,'is_admission_notice'=>1])->orderby('id','DESC')->get();
       return $this->sendResponse($notice, 'Notice retrieved successfully.');  
    }
   public function online_admission_application(Request $request, SmsSendController $sms_send){
       $data1=$request->all();
        $data=$data1[0];
      $validator = Validator::make($data, [
            'name_bn' => 'required',
            'name_en' => 'required',
            'father_name_bn' => 'required',
            'father_name_en' => 'required',
            'mother_name_bn' => 'required',
            'mother_name_en' => 'required',
            'birth_certificate_no' => 'required',
            'dob' => 'required',
            'parents_income' => 'required',
            'parents_phone' => 'required',
            'phone' => 'required',
            'religion' => 'required',
            'nationality' => 'required',
            'parmanent_vill' => 'required',
            'parmanent_post' => 'required',
            'parmanent_upozila' => 'required',
            'parmanent_zila' => 'required',
            'present_vill' => 'required',
            'present_post' => 'required',
            'present_upozila' => 'required',
            'present_zila' => 'required',
            'picture' => 'required',
            'signature' => 'required',
            'exam_name' => 'required',
            'roll_no' => 'required',
            'registration_no' => 'required',
            'board' => 'required',
            'institute' => 'required',
            'passing_year' => 'required',
            'gpa' => 'required',
            /*'subject' => 'required',
            'subject_optional' => 'required',*/
       ]);


        if ($validator->fails()) {
           $status=0;
          return $this->sendResponse($status, 'something is wrong.');  
            //return back()->with("danger", "Something is wrong ");
        }
        
        $data1=$request->all();
        $data=$data1[0];
        $school=School::where('serial_no',$data['school_id'])->first();
        $data['reg_no']=rand('10000','99999999');
        $data['password']=rand('10000','99999999');
        $data['type']=1;
        $data['picture']=$data['picture'];
        $data['signature']=$data['signature'];
        $data['school_id']=$school->id;
         $admission=OnlineAdmission::where(['school_id'=>$data['school_id'],'status'=>1])->first();
        $data['online_admission_id']=$admission->id;
         $check_phone=OnlineAdmissionApplication::where(['phone'=>$data['phone'],'status'=>1,'school_id'=>$data['school_id']])->first();
         if ($check_phone) {
             OnlineAdmissionApplication::where(['phone'=>$data['phone'],'status'=>1])->update(['status'=>0]);
         }
         $application = OnlineAdmissionApplication::create($data);
         $data['o_a_application_id']=$application->id;
         $a=0;
         foreach ($data['roll_no'] as $row) {
           $info = OnlineAdmissionAccademicInfo::create(['exam_name'=>$data['exam_name'][$a],'roll_no'=>$data['roll_no'][$a],'registration_no'=>$data['registration_no'][$a],'board'=>$data['board'][$a],'institute'=>$data['institute'][$a],'passing_year'=>$data['passing_year'][$a],'gpa'=>$data['gpa'][$a],'school_id'=>$data['school_id'],'o_a_application_id'=>$application->id]);
           $a++;
         }
         if ($request->subject) {
          
         foreach ($data['subject'] as $subject) {
            $subject = OnlineAdmissionApplicationSubject::create(['name'=>$subject,'type'=>2,'o_a_application_id'=>$application->id,'school_id'=>$data['school_id']]);
         }
            $subject = OnlineAdmissionApplicationSubject::create(['name'=>$data['subject_optional'],'type'=>3,'o_a_application_id'=>$application->id,'school_id'=>$data['school_id']]);

            $subject = OnlineAdmissionApplicationSubject::create(['name'=>'Bangla','type'=>1,'o_a_application_id'=>$application->id,'school_id'=>$data['school_id']]);
            $subject = OnlineAdmissionApplicationSubject::create(['name'=>'ICT','type'=>1,'o_a_application_id'=>$application->id,'school_id'=>$data['school_id']]);
           $subject = OnlineAdmissionApplicationSubject::create(['name'=>'English','type'=>1,'school_id'=>$data['school_id'],'o_a_application_id'=>$application->id]);
         }
         if ($application->id) {
           $content='Dear '.$data['name_bn'].' Your admit card download information ! Web address : '.$school->website.'/admit_card_check , Reg No : '.$data['reg_no'].', Password : '.$data['password'].' ';
           $message= urlencode($content);
           $mobile_number=$sms_send->validateNumber([0=>$data['phone']]);
           $mobile_number = implode(',',$mobile_number);
           $a = $this->sms_send_by_api($school,$mobile_number,$message);
         }
           $status=1;
      return $this->sendResponse($status, 'admission data retrieved successfully.');  
    }
    
   public function online_admission_application_form(Request $request)
    {
        
        $school=School::where('serial_no',$request->serial_no)->first();
        $data['admission']=OnlineAdmission::where(['school_id'=>$school->id,'status'=>1])->first();
        $data['class']=MasterClass::get();
         
        return $this->sendResponse($data, 'online admission data retrieved successfully.'); 
    }
    public function merit_list(Request $request)
    {
        
        $school=School::where('serial_no',$request->serial_no)->first();
        $admission=OnlineAdmission::where(['school_id'=>$school->id,'status'=>1])->first();
        $merit_list=[];
        if($admission){
         $merit_list=OnlineAdmissionApplication::where(['online_admission_id'=>$admission->id,'school_id'=>$school->id,'status'=>2])->get();
        }
        return $this->sendResponse($merit_list, 'merit list data retrieved successfully.'); 
    }
    public function waiting_list(Request $request)
    {
        
        $school=School::where('serial_no',$request->serial_no)->first();
        $admission=OnlineAdmission::where(['school_id'=>$school->id,'status'=>1])->first();
        $merit_list=[];
        if($admission){
         $merit_list=OnlineAdmissionApplication::where(['online_admission_id'=>$admission->id,'school_id'=>$school->id,'status'=>3])->get();
        }
        return $this->sendResponse($merit_list, 'merit list data retrieved successfully.'); 
    }
    
    public function admit_card(Request $request)
    {
        $data1=$request->all();
        $data=$data1[0];
        //$password=bcrypt($data['password']);
        $password=$data['password'];
        $school=School::where('serial_no',$data['school_id'])->first();
        $admission=OnlineAdmission::where(['school_id'=>$school->id,'status'=>1])->whereDate('end_date','>=',date('Y-m-d'))->first();
        $admit=[];
        if($admission){
         $admit=OnlineAdmissionApplication::with('online_admission','masterClass')->where(['online_admission_id'=>$admission->id,'school_id'=>$school->id,'status'=>2,'reg_no'=>$data['reg_no'],'password'=>$password])->first();
        }
        return $this->sendResponse($admit, 'admit data retrieved successfully.'); 
    }

}
