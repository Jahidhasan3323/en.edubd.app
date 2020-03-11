<?php

namespace App\Http\Controllers;

use App\School;
use App\Student;
use App\StudentClass;
use App\Teacher;
use App\Unit;
use App\MasterClass;
use App\GroupClass;
use App\IdGenerator;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use App\Http\Controllers\SmsSendController;
use Storage;


class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $students = Student::with('masterClass')
            ->where(['school_id'=>Auth::getSchool()])
            ->select(['master_class_id','group','section','shift'])
            ->selectRaw(
                'count(id) as total_student,session'
             )
            ->groupBy(['master_class_id','group','section','session','shift'])
            ->orderBy('id','desc')->current()->get();
        $student_type=0;
        return view('backEnd.students.index', compact('students','student_type'));
    }


    public function student_controll_by_root($school_id)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        $students = Student::with('masterClass')
            ->where(['school_id'=>$school_id])
            ->select(['master_class_id','group','section','shift'])
            ->selectRaw(
                'count(id) as total_student,session'
             )
            ->groupBy(['master_class_id','group','section','session','shift'])
            ->orderBy('id','desc')->current()->get();
        $student_type=0;
        $school = School::with('user')->where('id',$school_id)->first();
        return view('backEnd.students.index', compact('students','student_type','school'));
    }

    public function student_list_controll(Request $request)
    {
          $data=['school_id'=>$request->school_id,
               'master_class_id'=>$request->master_class_id,
               'group'=>$request->group,
               'section'=>$request->section,
               'shift'=>$request->shift,
               'session'=>$request->session];
          $students = Student::with('user','masterClass')
               ->where($data)->orderBy('id', 'desc')
               ->get();
          $school = School::where('id',$request->school_id)->first();
          return view('backEnd.students.student_controll.index', compact('students','school'));
    }

    public function student_id_card_active(Request $request, $master_class_id,$group,$section,$shift,$session,$school_id)
    {
          $data=[
               'school_id'=>$school_id,
               'master_class_id'=>$master_class_id,
               'group'=>$group,
               'section'=>$section,
               'shift'=>$shift,
               'session'=>$session
          ];
          if(is_array($request->student_id) && count($request->student_id)>0){
            $student_all_id = Student::where($data)->select('student_id')->get();
            $inactive_student_id=array_diff(collect($student_all_id)->pluck('student_id')->toArray(),$request->student_id);
            Student::where($data)->whereIn('student_id',$request->student_id)->update(['id_card_exits'=>1]);
            Student::where($data)->whereIn('student_id',$inactive_student_id)->update(['id_card_exits'=>0]);
          }else{
             Student::where($data)->update(['id_card_exits'=>0]);
          }

          return $this->returnWithSuccess('সফলভাবে পরিবর্তন হয়েছে...!!');

    }

    public function old_students_list()
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $students = Student::with('masterClass')
            ->where(['school_id'=>Auth::getSchool()])
            ->select(['master_class_id','group','section','shift'])
            ->selectRaw(
                'count(id) as total_student,session'
             )
            ->groupBy(['master_class_id','group','section','session','shift'])
            ->orderBy('id','desc')->old()->get();
        $student_type=1;

        return view('backEnd.students.index', compact('students','student_type'));
    }

    public function ClassStudentsList(Request $request)
    {

        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $data=['school_id'=>Auth::getSchool(),
               'master_class_id'=>$request->master_class_id,
               'group'=>$request->group,
               'section'=>$request->section,
               'shift'=>$request->shift,
               'session'=>$request->session];
        if($request->student_type==1){
           $students = Student::with('user','masterClass')
               ->where($data)->orderBy('id', 'desc')->old()->get();

        }else{
           $students = Student::with('user','masterClass')
               ->where($data)->orderBy('id', 'desc')
               ->current()->get();
        }
        if(count($students)>0){
          return view('backEnd.students.class_view', compact('students'));
        }else{
           if($request->student_type==1){
             Session::flash('sccmgs', 'শিক্ষার্থী সফলভাবে পুনরায় যোগ করা হয়েছে !');
             return redirect('old_students_list');
           }
           Session::flash('sccmgs', 'শিক্ষার্থী সফলভাবে মুছে ফেলা হয়েছে !');
           return redirect('students_list');
        }
    }

    public function students_print(Request $request){
       $students = json_decode($request->students);
       $students=collect($students)->sortBy('roll');
       $school = $this->school();
       return view('backEnd.students.students_print_view',compact('students','school'));
    }


    public function delete_student_parmanetly($id){
       try{
           DB::beginTransaction();
           $student = Student::with(['user','results','atten_students'])->where(['id'=>$id,'school_id'=>Auth::getSchool()])->onlyTrashed()->first();
           $student->user->delete();
           if(count($student->results)>0){$student->results->delete();}
            if(count($student->atten_students)>0){$student->atten_students->delete();}
           $student->delete();
           DB::commit();
           Session::flash('sccmgs', 'শিক্ষার্থী সফলভাবে মুছে ফেলা হয়েছে !');
           return redirect('old_students_list');
       }catch (\Exception $e){
           DB::rollback();
           Session::flash('errmgs', 'দুখিত, সমস্যা হয়েছে !'.$e->getMessage());
           return redirect()->back();
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $schoolId = Auth::getSchool();
        $student_id = $this->student_id_generator($schoolId);
        $school= School::where('id', $schoolId)->first();
        $student_limit=$school->total_student;
        $total_students=count($school->student()->get());
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $group_classes=GroupClass::all();
        $units=Unit::where('school_id',$schoolId)->get();
        return view('backEnd.students.registerStudent', compact('classes', 'units', 'schoolId', 'student_id','student_limit','total_students','group_classes','units'));
    }

    protected function student_id_generator($schoolId){
        $oldStudentId = Student::where('school_id', $schoolId)->select(array('student_id'))->orderBy('student_id', 'desc')->first();

        if ($oldStudentId) {
            $student_id = $oldStudentId->student_id;
            $student_id=number_format($student_id+1);
            $check_ids=IdGenerator::where([
                'id_type'=>'student_id',
                'school_id'=>$schoolId
            ])->get();
            foreach ($check_ids as $key => $check_id) {
                $now=strtotime(Carbon::now()->format("d/m/Y h:i:s a"));
                $created_at=strtotime($check_id->created_at->format("d/m/Y h:i:s a"));
                if(($now-$created_at)>3600){
                   IdGenerator::where(['id'=>$check_id->id,'id_type'=>'student_id','school_id'=>$schoolId])->delete();
                }
            }

            $student_id=str_replace(",","",$student_id);
            $ids=collect($check_ids)->pluck('created_id')->toArray();
            foreach ($check_ids as $check_id) {
                $created_id=$student_id++;
                if(in_array($created_id, $ids)==false){
                   $student_id=$created_id;
                   break;
                }
            }

        }else {
            $sum=1001111;
            $school=School::where('id',$schoolId)->first();
            $student_id = $school->country_code.''.$school->serial_no.''.date('y').''.$sum;
        }
        IdGenerator::create(['created_id'=>$student_id,'id_type'=>'student_id','school_id'=>$schoolId]);
        return $student_id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  Nrequest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SmsSendController $sms_send)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $validator=$this->validation($request);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try{
            DB::beginTransaction();
            $data = $request->except('password');
            $data = $request->except('photo');
            $data = $request->except('f_photo');
            $data = $request->except('m_photo');
            $data['password'] = bcrypt($request->password);
            $user = User::create($data);
            $user_id = $user->id;
            $data['user_id'] = $user_id;
            if($imageFile = $request->file('photo')){
               $data['photo'] = $this->imagesProcessing1($imageFile, 'studentPhoto',300,350);
            }
            if($imageFile = $request->file('f_photo')){
               $data['f_photo'] = $this->imagesProcessing1($imageFile, 'studentPhoto',300,350);
            }
            if($imageFile = $request->file('m_photo')){
               $data['m_photo'] = $this->imagesProcessing1($imageFile, 'studentPhoto',300,350);
            }

            $student=Student::create($data);
            $school=$this->school();
            if(isset($student->id) && $request->mobile!=NULL && $school->api_key!=NULL && $school->sender_id!=NULL){
               $school_name=$sms_send->school_name_process($school->user->name);
               $content='প্রিয় '.$request->name.' তোমার সফটওয়্যার লগইন তথ্য ! ওয়েব এড্রেস : '.$school->website.', ইমেইল : '.$request->email.', পাসওয়ার্ড : '.$request->password.'. '.$school_name;
               $message= urlencode($content);
               $mobile_number=$sms_send->validateNumber([0=>$request->mobile]);
               $mobile_number = implode(',',$mobile_number);
               $a = $this->sms_send_by_api($school,$mobile_number,$message);
            }

            DB::commit();
            if(isset($a)){
               Session::flash('sccmgs', 'শিক্ষার্থী সফলভাবে যোগ করা হয়েছে এবং এস,এম,এস পাঠানো হয়েছে: '.$a);
            }else{
               Session::flash('sccmgs', 'শিক্ষার্থী সফলভাবে যোগ করা হয়েছে !!');
            }
            return redirect()->back();

        }catch (\Exception $e){
            DB::rollback();
            Session::flash('errmgs', 'দুঃখিত, সমসয়া হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $student = $this->getStudent($student_id);
        return view('backEnd.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $studentData = Student::with('user')->where(['id'=>$student->id,'school_id'=>Auth::getSchool()])->first();
        $classes = $this->getClasses();
        $group_classes=GroupClass::all();
        $units=Unit::all();
        return view('backEnd.students.edit', compact('studentData', 'classes', 'units','group_classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        if (!Auth::is('admin') && !Auth::is('student')){
            return redirect('/home');
        }
        if (!Auth::is('student')){
            $validator=$this->validationForUpdate($request, $student);
        }else{
            $validator =Validator::make($request->all(),[
                         'email' => ['required','string','email','max:255', Rule::unique('users', 'email')->ignore($student->user->id)],
                     ]);
        }
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try{
            $data = $request->except(['photo','f_photo','m_photo','password']);
            if($request->password){
              $data['password'] = bcrypt($request->password);
            }

            if($imageFile = $request->file('photo')){
               $data['photo'] = $this->imagesProcessing1($imageFile, 'studentPhoto',300,350);
               if (file_exists(public_path(Storage::url($student->photo)))){
                  Storage::delete($student->photo);
                }
            }
            if($imageFile = $request->file('f_photo')){
               $data['f_photo'] = $this->imagesProcessing1($imageFile, 'studentPhoto',300,350);
               if (file_exists(public_path(Storage::url($student->f_photo)))){
                  Storage::delete($student->f_photo);
                }
            }
            if($imageFile = $request->file('m_photo')){
               $data['m_photo'] = $this->imagesProcessing1($imageFile, 'studentPhoto',300,350);
               if (file_exists(public_path(Storage::url($student->m_photo)))){
                  Storage::delete($student->m_photo);
                }
            }
            $users = User::find($student->user_id);
            DB::beginTransaction();
            if ($users->update($data) && $student->update($data)){
                DB::commit();
                if (Auth::is('student')){
                    Session::flash('sccmgs', 'আপনার প্রোফাইল সফলভাবে আপডেট করা হয়েছে !');
                    return redirect()->back();
                }
                Session::flash('sccmgs', 'শিক্ষার্থী সফলভাবে আপডেট করা হয়েছে !');
                return redirect()->back();
            }

        }catch (\Exception $e){
            DB::rollback();
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $student=Student::with(['user','results','atten_students'])->where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
        try{
            $data['deleted_at']=Carbon::now();
            $student->user->update($data);
            if(isset($student->results)&&count($student->results)>0){$student->results->each->update($data);}
            if(isset($student->atten_students)&&count($student->atten_students)>0){$student->atten_students->each->update($data);}
            $data['id_card_exits']=1;
            $student->update($data);
            Session::flash('sccmgs', 'শিক্ষার্থী সফলভাবে মুছে ফেলা হয়েছে !');
            return redirect()->back();
        }catch (\Exception $e){
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function restore($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        try{
            $student=Student::with(['user','results','atten_students'])
                    ->where(['id'=>$id,'school_id'=>Auth::getSchool()])
                    ->old()->first();
            $data['deleted_at']=NULL;
            $student->user->update($data);
            if(isset($student->results)&&count($student->results)>0){$student->results->each->update($data);}
            if(isset($student->atten_students)&&count($student->atten_students)>0){$student->atten_students->each->update($data);}
            $student->update($data);
            Session::flash('sccmgs', 'শিক্ষার্থী সফলভাবে পূনরায় সফলভাবে যোগ করা হয়েছে !');
            return redirect()->back();
        }catch (\Exception $e){
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function profile()
    {
        if (!Auth::is('student')){
            return redirect('/home');
        }
        $id = Student::where('user_id', Auth::user()->id)->select(array('id'))->first();
        $student = $this->getStudent($id->id);
        return view('backEnd.students.profile', compact('student'));
    }

    public function editProfile()
    {
        $studentData = Student::where('user_id', Auth::user()->id)->first();
        return view('backEnd.students.editProfile', compact('studentData'));
    }

    protected function validation(Request $request)
    {
     return $validator =Validator::make($request->all(), [
                 /*academic*/
             'name' => 'required|max:150',
             'gender' => 'required',
             'master_class_id' => 'required',
             'shift' => 'required',
             'section' => 'required',
             'group' => 'required',
             'roll' => 'required',
             'session' => 'required',
             'student_id' => 'required|unique:students',
             'regularity' => 'required',

              /*personal information*/
             'birthday' => 'required',
             'blood_group' => 'nullable',
             'email' => 'required|email|max:191|unique:users',
             'password' => 'required|min:6',
             'religion' => 'required',
             'birth_rg_no' => 'required',
             'mobile' => 'nullable',
             'last_sd_org' => 'nullable',
             're_to_lve' => 'nullable',

                /*present address*/
             'pre_address' => 'nullable',
             'Pre_h_no' => 'nullable',
             'pre_ro_no' => 'nullable',
             'pre_vpm' => 'required',
             'pre_poff' => 'required',
             'pre_unim' => 'required',
             'pre_subd' => 'required',
             'pre_district' => 'required',
             'pre_postc' => 'nullable',

                /*permatent address*/
             'per_address' => 'nullable',
             'per_h_no' => 'nullable',
             'per_ro_no' => 'nullable',
             'per_vpm' => 'nullable',
             'per_poff' => 'nullable',
             'per_unim' => 'nullable',
             'per_subd' => 'nullable',
             'per_district' => 'nullable',
             'per_postc' => 'nullable',

               /*Parental Information*/
             'father_name' => 'required',
             'f_career' => 'required',
             'f_m_income' => 'nullable',
             'f_edu_c' => 'nullable',
             'f_mobile_no' => 'nullable',
             'f_email' => 'nullable|email|max:191',
             'f_nid' => 'nullable',
             'mother_name' => 'required',
             'm_career' => 'required',
             'm_m_income' => 'nullable',
             'relation' => 'nullable',
             'm_mobile_no' => 'nullable',
             'm_email' => 'nullable|email|max:191',
             'm_nid' => 'nullable',

             /*Name of Local Guardian in Absence of Parent / Mother */
             'local_gar' => 'nullable',
             'career' => 'nullable',
             'guardian_edu' => 'nullable',
             'guardian_mobile' => 'nullable',
             'guardian_email' => 'nullable|email|max:191',
             'guardian_nid' => 'nullable',
             'school_id' => 'nullable',
             'group_id' => 'nullable',
             'created_by' => 'nullable',
             'photo' => 'required|image',
             'f_photo' => 'required|image',
             'm_photo' => 'required|image',

        ]);

    }

    protected function validationForUpdate(Request $request, $student)
    {
     return $validator =Validator::make($request->all(), [
                 /*academic*/
             'name' => 'required|max:150',
             'gender' => 'required',
             'master_class_id' => 'required',
             'shift' => 'required',
             'section' => 'required',
             'group' => 'required',
             'roll' => 'required',
             'session' => 'required',
             'regularity' => 'required',

              /*personal information*/
             'birthday' => 'required',
             'blood_group' => 'nullable',
             'email' => ['required','string','email','max:255', Rule::unique('users', 'email')->ignore($student->user->id)],
             'password' => 'nullable|min:6',
             'religion' => 'required',
             'birth_rg_no' => 'required',
             'mobile' => 'nullable',
             'last_sd_org' => 'nullable',
             're_to_lve' => 'nullable',

                /*present address*/
             'pre_address' => 'nullable',
             'Pre_h_no' => 'nullable',
             'pre_ro_no' => 'nullable',
             'pre_vpm' => 'required',
             'pre_poff' => 'required',
             'pre_unim' => 'required',
             'pre_subd' => 'required',
             'pre_district' => 'required',
             'pre_postc' => 'nullable',

                /*permatent address*/
             'per_address' => 'nullable',
             'per_h_no' => 'nullable',
             'per_ro_no' => 'nullable',
             'per_vpm' => 'nullable',
             'per_poff' => 'nullable',
             'per_unim' => 'nullable',
             'per_subd' => 'nullable',
             'per_district' => 'nullable',
             'per_postc' => 'nullable',

               /*Parental Information*/
             'father_name' => 'required',
             'f_career' => 'required',
             'f_m_income' => 'nullable',
             'f_edu_c' => 'nullable',
             'f_mobile_no' => 'nullable',
             'f_email' => 'nullable|email|max:191',
             'f_nid' => 'nullable',
             'mother_name' => 'required',
             'm_career' => 'required',
             'm_m_income' => 'nullable',
             'relation' => 'nullable',
             'm_mobile_no' => 'nullable',
             'm_email' => 'nullable|email|max:191',
             'm_nid' => 'nullable',

             /*Name of Local Guardian in Absence of Parent / Mother */
             'local_gar' => 'nullable',
             'career' => 'nullable',
             'guardian_edu' => 'nullable',
             'guardian_mobile' => 'nullable',
             'guardian_email' => 'nullable|email|max:191',
             'guardian_nid' => 'nullable',
             'photo' => 'nullable|image',
             'f_photo' => 'nullable|image',
             'm_photo' => 'nullable|image',

        ]);

    }




    protected function getSchoolClassUnit($schoolId)
    {
        $units = DB::table('school_class_units')
                ->join('units', 'school_class_units.unit_id', '=', 'units.id')
                ->where('school_class_units.school_id', $schoolId)
                ->select(array(
                    'units.id as unit_id',
                    'units.name as unit'
                ))
                ->get();
        return $units;
    }

    protected function getStudent($student_id)
    {
        $student = Student::with('user','masterClass')
            ->where('id', $student_id)
            ->where('school_id', Auth::getSchool())
            ->first();
        return $student;
    }

    protected function getClasses()
    {

        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        return $classes;
    }




    /**
     * @param Request $request
     * @return int
     */
    public function mobileCheck(Request $request)
    {
        $mobile = $request->all()['mobile'];
        $data = User::where('mobile', $mobile)->get();
        if ($data->count()){
            return 1;
        }
        return 0;
    }

    public function rollCheck(Request $request)
    {
        $roll = $request->all()['roll'];
        $classId = $request->all()['classId'];
        $schoolId = $request->all()['schoolId'];
        $checkData = Student::where([
            ['roll', '=', $roll],
            ['master_class_id', '=', $classId],
            ['school_id', '=', $schoolId]
        ])->get();

        if ($checkData->count()){
            return 1;
        }
        return 0;
    }

    protected function getSession()
    {
        return StudentClass::select(array('session'))->groupBy('session')->orderBy('session', 'des')->get();
    }
}
