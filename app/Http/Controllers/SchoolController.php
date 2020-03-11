<?php

namespace App\Http\Controllers;

use App\group_id;
use App\MasterClass;
use App\School;
use App\WmImportantLinksRoot;
use App\WmImportantLinksCategory;
use App\WmImportantLinksCategoryRoot;
use App\WmImportantLink;
use App\User;
use App\SchoolType;
use App\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\ClassController;
use App\Custom\School\School_delete;
use Storage;
use Illuminate\Validation\Rule;

class SchoolController extends Controller
{
    protected $logo;
    protected $signatureP;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::is('root')){
            return view('backEnd.admin.dashboard');
        }
        return view('backEnd.schools.info');
    }


    public function schoolUsers()
    {
        if (!Auth::is('root')){
            return view('backEnd.admin.dashboard');
        }
        return view('backEnd.schools.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::is('root')){
            return view('backEnd.admin.dashboard');
        }
        $school_types=ClassController::getSchoolTypes();
        $service_types=ServiceType::all();
        return view('backEnd.schools.add',compact('school_types','service_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::is('root')){
            return view('backEnd.admin.dashboard');
        }
        $validator=$this->validation($request);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        try{
            DB::beginTransaction();
            $schoolData = $request->except('logo');
            $schoolData = $request->except('signature_p');
            $user_id = $this->saveToUserTable($request);
            $schoolData['user_id'] = $user_id;
            $school_type_id=implode("|",$request->school_type_id);
            $schoolData['school_type_id'] = $school_type_id;
            if($imageFile = $request->file('logo')){
               $this->logo=$this->imagesProcessing1($imageFile, 'schoolLogo',300,350);
               $schoolData['logo']=$this->logo;
            }

            if($imageFile = $request->file('signature_p')){
               $this->signatureP=$this->imagesProcessing1($imageFile, 'schoolLogo',300,350);
               $schoolData['signature_p']=$this->signatureP;
            }

            $schooln=School::create($schoolData);
            $link_categorys=WmImportantLinksCategoryRoot::where('school_type_id',$schooln->school_type_id)->get();
            if ($link_categorys) {
                foreach ($link_categorys as $link_category) {
                    WmImportantLinksCategory::insert(['tittle'=>$link_category->tittle,'school_id'=>$schooln->id]);
                }
            }
            $links=WmImportantLinksRoot::where('school_type_id',$schooln->school_type_id)->get();
            if ($links) {
                foreach ($links as $link) {
                    WmImportantLink::insert(['tittle'=>$link->tittle,'link'=>$link->link,'wm_important_links_category_id'=>$link->wm_important_links_category_id,'school_id'=>$schooln->id]);
                }
            }
            DB::commit();
           $text="Dear user, Your super dynamic web site and web application is running for use. Web address:".$schooln->website.", User:".$schooln->user->email."/".$schooln->user->mobile.", Password:".$request->password." @Ehsan Software";

           $text=urlencode($text);
           $url_AllNumber="https://api.mobireach.com.bd/SendTextMultiMessage?Username=esoftware&Password=Abcd@4321&From=8801847417295&To=88".$schooln->user->mobile."&Message=".$text;
            $res = $this->send_sms_by_curl($url_AllNumber);
            Session::flash('sccmgs', 'Client School successfully added and'.$res);
            return redirect()->back();
        }catch (\Exception $e){
            DB::rollback();
            if (file_exists(public_path(Storage::url($this->logo)))){
                Storage::delete($this->logo);
            }
            if (file_exists(public_path(Storage::url($this->signatureP)))){
                Storage::delete($this->signatureP);
            }
            Session::flash('errmgs', $e->getMessage());
            DB::rollback();
            return redirect()->back();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        if (!Auth::is('root')){
            return view('backEnd.admin.dashboard');
        }

        $showData = $this->getSchoolDataToShow($school->user_id);
        $school_type_ids=explode('|', $showData->school_type_id);
        $school_types=SchoolType::whereIn('id',$school_type_ids)->select('type')->get();
        return view('backEnd.schools.show', compact('showData','school_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        if (!Auth::is('root')){
            return view('backEnd.admin.dashboard');
        }

        $showData = $this->getSchoolDataToShow($school->user_id);
        $school_types=ClassController::getSchoolTypes();
        $school_type_ids=explode('|', $showData->school_type_id);
        $service_types=ServiceType::all();
        return view('backEnd.schools.edit', compact('showData','school_types','school_type_ids','service_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        if(!Auth::is('root') && !Auth::is('admin')){
            return view('backEnd.admin.dashboard');
        }

        $this->validatorForUpdate($request,$school->id,$school->user->id);
        $data = $request->except(['logo','signatur_p','_token','_method']);
        $data['api_key']=$request->api_key;
        $data['sender_id']=$request->sender_id;
        if($request->school_type_id){
           $data['school_type_id']=implode("|",$request->school_type_id);
        }
        if($imageFile = $request->file('logo')){
           $this->logo=$this->imagesProcessing1($imageFile, 'schoolLogo',300,350);
           $data['logo'] = $this->logo;
           if (file_exists(public_path(Storage::url($school->logo)))){
                Storage::delete($school->logo);
           }
        }
        if($imageFile = $request->file('signature_p')){
           $this->signatureP=$this->imagesProcessing1($imageFile, 'schoolLogo',300,350);
           $data['signature_p'] = $this->signatureP;
           if (file_exists(public_path(Storage::url($school->signature_p)))){
                Storage::delete($school->signature_p);
           }
        }
        try {
            $users = User::find($school->user_id);
            DB::beginTransaction();
            if ($users->update($data) && $school->update($data)){
                DB::commit();

                if (Auth::is('admin')){
                    Session::flash('sccmgs', 'আপনার প্রোফাইল সফলভাবে আপডেট হয়েছে !');
                    return redirect('/editSchoolProfile');
                }
                Session::flash('sccmgs', 'ক্লায়েন্ট স্কুল সফলভাবে আপডেট হয়েছে !');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            if (file_exists(public_path(Storage::url($this->signatureP)))){
                Storage::delete($this->signatureP);
            }
            if (file_exists(public_path(Storage::url($this->logo)))){
                Storage::delete($this->logo);
            }
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }



    public function profile()
    {
        if (!Auth::is('admin')){
            return view('backEnd.admin.dashboard');
        }
        $showData = $this->getSchoolDataToShow(Auth::user()->id);
        $school_type_ids=explode('|', $showData->school_type_id);
        $school_types=SchoolType::whereIn('id',$school_type_ids)->select('type')->get();
        return view('backEnd.schools.profile', compact('showData','school_types'));
    }

    public function editProfile()
    {
        if (!Auth::is('admin')){
            return view('backEnd.admin.dashboard');
        }
        $showData = $this->getSchoolDataToShow(Auth::user()->id);
        $school_types=ClassController::getSchoolTypes();
        $school_type_ids=explode('|', $showData->school_type_id);
        return view('backEnd.schools.editProfile', compact('showData','school_type_ids', 'school_types'));
    }

    /*
     * Custom validation ......
     */
    protected function validation(Request $request)
    {

        return $validator =Validator::make($request->all(), [
                   'name' => 'required',
                   'email' => 'required|email|unique:users',
                   'password' => 'required|min:6',
                   'address' => 'required',
                   'mobile' => 'required|unique:users',
                   'code' => 'required|unique:schools',
                   'established_date' => 'required|date',
                   'expiry_date' => 'required|date',
                   'country_code' => 'required',
                   'serial_no' => 'required',
                   'logo' => 'required|image|max:2048',
                   'signature_p' => 'nullable|image|max:2048',
                   'total_student' => 'required',
                   'school_type_id' => 'required',
                   'status' => 'required',

           ]);
    }

    protected function validatorForUpdate(Request $request,$school_id,$user_id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => ['required','email','max:255', Rule::unique('users', 'email')->ignore($user_id)],
            'address' => 'required',
            'mobile' => ['required','max:255', Rule::unique('users', 'mobile')->ignore($user_id)],
            'logo' => 'nullable|image|max:2048',
            'signature_p' => 'nullable|image|max:2048',
        ]);
    }

    public static function getSchools()
    {
        $schools = DB::table('users')
            ->join('schools', 'users.id', '=', 'schools.user_id')
            ->join('service_types', 'service_types.id', '=', 'schools.service_type_id')
            ->select('schools.*','users.name','users.email','users.mobile','service_types.type as service_type')
            ->orderBy('schools.id', 'desc')
            ->get();
        return $schools;
    }

    public static function getAllSchools()
    {
        $schools = DB::table('users')
            ->join('schools', 'users.id', '=', 'schools.user_id')
            ->get();
        return $schools;
    }


    /*
     * Send data to user table.........
     */
    protected function saveToUserTable(Request $data)
    {
        $userData = $data->all();
        $userData['password'] = bcrypt($data->password);
        if ($user = User::create($userData)){
            return $user->id;
        }else{
            return false;
        }
    }

    protected function getSchoolDataToShow($school_id)
    {
        return DB::table('schools')
            ->join('users', 'schools.user_id', '=', 'users.id')
            ->select('schools.*','users.name','users.email','users.mobile')
            ->where('schools.user_id', $school_id)
            ->first();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($school_id)
    {
        try {
            DB::beginTransaction();
            $res=new school_delete($school_id);
            $res->users();
            $res->atten_employees();
            $res->atten_students();
            $res->subjects();
            $res->subject_teachers();
            $res->units();
            $res->destroy();
            Session::flash('sccmgs', 'সফলভাবে মুছে ফেলা হয়েছে..!');
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('errmgs', $e->getMessage());
            return redirect()->back();
        }
    }
}
