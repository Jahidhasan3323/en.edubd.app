<?php
namespace App\Http\Controllers;

use App\School;
use App\Staff;
use App\Designation;
use App\User;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SmsSendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Storage;
use Carbon\Carbon;

class StaffController extends Controller
{
    protected $photo = null;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Checking for teacher management permission
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::is('admin') && !Auth::is('commitee') && !Auth::is('staff') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $staffs = Staff::with('user','user.group')->where('school_id',Auth::getSchool())->current()->get();
        return view('backEnd.staffs.info', compact('staffs'));
    }

    public function old_staff()
    {
        if (!Auth::is('admin') && !Auth::is('commitee') && !Auth::is('staff') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $staffs = Staff::with('user','user.group')->where('school_id',Auth::getSchool())->old()->get();
        $old=1;
        return view('backEnd.staffs.info', compact('staffs','old'));
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

        $designations = Designation::where('type', 1)->get();
        $groups=Group::whereIn('permission',['teacher','staff'])->get();
        $school_id = Auth::getSchool();
        $staff_id = Staff::where('school_id', $school_id)->select(array('staff_id'))->orderBy('staff_id', 'desc')->first();
        if ($staff_id) {
            $staff_id = $staff_id->staff_id;
            $staff_id=number_format($staff_id+1);
            $staff_id=str_replace(",","",$staff_id);
        }else {
            $sum=1011;
            $school=School::where('id',$school_id)->first();
            $staff_id = $school->country_code.''.$school->serial_no.''.date('y').''.$sum;
        }

        return view('backEnd.staffs.add', compact('designations', 'school_id','staff_id','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        if($imageFile = $request->file('photo')){
        $this->photo=$this->imagesProcessing1($imageFile, 'teacherPhoto',300,350);
        }
        try{
            DB::beginTransaction();
            $data = $request->except('password');
            $data = $request->except('photo');
            $data['password'] = bcrypt($request->password);
            $user = User::create($data);
            $data['user_id'] = $user->id;
            $data['photo'] = $this->photo;
            $staff=Staff::create($data);
            $school=$this->school();
            $a='';
            if(isset($staff->id) && $request->mobile!=NULL && $school->api_key!=NULL && $school->sender_id!=NULL){
               $school_name=$sms_send->school_name_process($school->user->name);
               $content='প্রিয় '.$request->name.' আপনার সফটওয়্যার লগইন তথ্য ! ওয়েব এড্রেস : '.$school->website.', ইমেইল : '.$request->email.', পাসওয়ার্ড : '.$request->password.'. '.$school_name;
               $message= urlencode($content);
               $mobile_number=$sms_send->validateNumber([0=>$request->mobile]);
               $mobile_number = implode(',',$mobile_number);
               $a = $this->sms_send_by_api($school,$mobile_number,$message);
            }
            DB::commit();
            Session::flash('sccmgs', 'স্টাফ সফলভাবে যোগ করা হয়েছে !'.$a);
            return redirect()->back();

        }catch (\Exception $e){
            DB::rollback();
            if (file_exists(public_path(Storage::url($this->photo)))) {
                Storage::delete($this->photo);
            }
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        return view('backEnd.staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $designations = Designation::where('type', 1)->get();
        $groups=Group::whereIn('permission',['admin','teacher','staff'])->get();

        return view('backEnd.staffs.edit', compact('designations', 'staff','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }

        if (!Auth::is('teacher')){
            $validator=$this->validationForUpdate($request,$staff);
        }else{

            $validator =Validator::make($request->all(), [
                        'email' => ['required','string','email','max:255', Rule::unique('users', 'email')->ignore($staff->user->id)],
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        try{
            $data = $request->except('photo');
            $data = $request->except('password');
            if($request->password){
                $data['password'] = bcrypt($request->password);
            }
            $user = User::where('id', $staff->user_id)->first();
            DB::beginTransaction();
            $user->update($data);

            if($imageFile = $request->file('photo')){
                $this->photo=$this->imagesProcessing1($imageFile, 'teacherPhoto',300,350);
                if (file_exists(public_path(Storage::url($staff->photo)))){
                    Storage::delete($staff->photo);
                }
                $data['photo'] = $this->photo;
            }
            $staff->update($data);
            DB::commit();
            if (Auth::is('teacher')){
                Session::flash('sccmgs', 'স্টাফ সফলভাবে আপডেট করা হয়েছে !');
                return redirect()->back();
            }
            Session::flash('sccmgs', 'স্টাফ সফলভাবে আপডেট হয়েছে !');
            return redirect()->back();

        }catch (\Exception $e){
            DB::rollback();
            if (file_exists(public_path(Storage::url($this->photo)))){
                    Storage::delete($this->photo);
                }
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        };

        try{
            $this->photo = $staff->photo;
            if (User::where(['id'=>$staff->user_id])->delete() && $staff->delete()){
                if (file_exists(public_path(Storage::url($this->photo)))){
                    Storage::delete($this->photo);
                }
            }else{
                throwException("অপারেশন ব্যর্থ");
            }
            Session::flash('sccmgs', 'স্টাফ সফলভাবে মুছে ফেলা হয়েছে !');
            return redirect()->back();
        }catch (\Exception $e){
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }


    public function profile()
    {

        $staff = Staff::where(['user_id'=>Auth::user()->id,'school_id'=>Auth::getSchool()])->first();
        return view('backEnd.staffs.profile', compact('staff'));
    }


    public function editProfile()
    {
        $staff = Staff::where(['user_id'=>Auth::user()->id,'school_id'=>Auth::getSchool()])->first();

        return view('backEnd.staffs.editProfile', compact('staff'));
    }

    protected function validation(Request $request)
    {
        return $validator =Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required|min:6',
            'group_id' => 'required',
            'mobile' => 'required|unique:users',
            'gender'=> 'required',
            'designation_id'=> 'required',
            'type'=> 'required',
            'salary'=> 'nullable',
            'subject'=> 'required',
            'edu_qulif'=> 'required',
            'training'=> 'nullable',
            'joining_date'=> 'required',
            'retirement_date'=> 'nullable',
            'index_no'=> 'nullable',
            'date_of_mpo'=> 'nullable',
            'staff_id'=> 'required',
            'school_id'=> 'required',
            'birthday'=> 'required',
            'blood_group'=> 'nullable',
            'religion'=> 'required',
            'nid_card_no'=> 'required',
            'last_org_name'=> 'nullable',
            'reason_to_leave'=> 'nullable',
            'last_org_address'=> 'nullable',
            'pre_address'=> 'nullable',
            'Pre_h_no'=> 'nullable',
            'pre_ro_no'=> 'nullable',
            'pre_vpm'=> 'required',
            'pre_poff'=> 'required',
            'pre_unim'=> 'required',
            'pre_subd'=> 'required',
            'pre_district'=> 'required',
            'pre_postc'=> 'nullable',
            'per_address'=> 'nullable',
            'per_h_no'=> 'nullable',
            'per_ro_no'=> 'nullable',
            'per_vpm'=> 'nullable',
            'per_poff'=> 'nullable',
            'per_unim'=> 'nullable',
            'per_subd'=> 'nullable',
            'per_district'=> 'nullable',
            'per_postc'=> 'nullable',
            'father_name'=> 'required',
            'f_career'=> 'required',
            'f_m_income'=> 'nullable',
            'f_edu_c'=> 'nullable',
            'f_mobile_no'=> 'nullable',
            'f_email'=> 'nullable',
            'f_nid'=> 'nullable',
            'mother_name'=> 'required',
            'm_career'=> 'required',
            'm_m_income'=> 'nullable',
            'relation'=> 'nullable',
            'm_mobile_no'=> 'nullable',
            'm_email'=> 'nullable',
            'm_nid'=> 'nullable',
            'h_w_name'=> 'nullable',
            'profession'=> 'nullable',
            'wedding_date'=> 'nullable',
            'h_w_edu_qulif'=> 'nullable',
            'h_w_nid_no'=> 'nullable',
            'h_w_mobile_no'=> 'nullable',
            'kids'=> 'nullable',
            'photo'=> 'required|image',
        ]);
    }

    protected function validationForUpdate(Request $request, $staff)
    {
        return $validator =Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => ['required','string','email','max:255', Rule::unique('users', 'email')->ignore($staff->user->id)],
            'password' => 'nullable|min:6',
            'group_id' => 'required',
            'mobile' => ['required',Rule::unique('users', 'mobile')->ignore($staff->user->id)],
            'gender'=> 'required',
            'designation_id'=> 'required',
            'type'=> 'required',
            'salary'=> 'nullable',
            'subject'=> 'required',
            'edu_qulif'=> 'required',
            'training'=> 'nullable',
            'joining_date'=> 'required',
            'retirement_date'=> 'nullable',
            'index_no'=> 'nullable',
            'date_of_mpo'=> 'nullable',
            'birthday'=> 'required',
            'blood_group'=> 'nullable',
            'religion'=> 'required',
            'nid_card_no'=> 'required',
            'last_org_name'=> 'nullable',
            'reason_to_leave'=> 'nullable',
            'last_org_address'=> 'nullable',
            'pre_address'=> 'nullable',
            'Pre_h_no'=> 'nullable',
            'pre_ro_no'=> 'nullable',
            'pre_vpm'=> 'required',
            'pre_poff'=> 'required',
            'pre_unim'=> 'required',
            'pre_subd'=> 'required',
            'pre_district'=> 'required',
            'pre_postc'=> 'nullable',
            'per_address'=> 'nullable',
            'per_h_no'=> 'nullable',
            'per_ro_no'=> 'nullable',
            'per_vpm'=> 'nullable',
            'per_poff'=> 'nullable',
            'per_unim'=> 'nullable',
            'per_subd'=> 'nullable',
            'per_district'=> 'nullable',
            'per_postc'=> 'nullable',
            'father_name'=> 'required',
            'f_career'=> 'required',
            'f_m_income'=> 'nullable',
            'f_edu_c'=> 'nullable',
            'f_mobile_no'=> 'nullable',
            'f_email'=> 'nullable',
            'f_nid'=> 'nullable',
            'mother_name'=> 'required',
            'm_career'=> 'required',
            'm_m_income'=> 'nullable',
            'relation'=> 'nullable',
            'm_mobile_no'=> 'nullable',
            'm_email'=> 'nullable',
            'm_nid'=> 'nullable',
            'h_w_name'=> 'nullable',
            'profession'=> 'nullable',
            'wedding_date'=> 'nullable',
            'h_w_edu_qulif'=> 'nullable',
            'h_w_nid_no'=> 'nullable',
            'h_w_mobile_no'=> 'nullable',
            'kids'=> 'nullable',
            'photo'=> 'nullable|image',
        ]);
    }



    public function mobileCheck(Request $request)
    {
        $mobile = $request->all()['mobile'];
        $data = User::where('mobile', $mobile)->get();
        if ($data->count()){
            return 1;
        }
        return 0;
    }

    public function staff_regine()
    {
        $all_staff = Staff::with('user')->where('school_id',Auth::getSchool())->current()->get();
        return view('backEnd.staffs.regine')->with(['all_staff'=>$all_staff]);
    }

    public function staff_regine_store(Request $request)
    {
        $this->validate($request, [
            'staff_id' => 'required',
            'date' => 'required'
        ]);
        try {
            $staff = Staff::with('user')->where(['id'=>$request->staff_id,'school_id'=>Auth::getSchool()])->first();
            $staff->user->update([
                'deleted_at'=>Carbon::now()
            ]);

            $staff->update([
                'deleted_at'=>Carbon::now(),
                'retirement_date'=>$request->date
            ]);
            Session::flash('sccmgs', 'রিজাইন সফল হয়েছে !');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }

}
