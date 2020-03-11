<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use App\Commitee;
use App\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SmsSendController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Storage;


class CommiteeController extends Controller
{
    public $image = null;
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
        if(!Auth::is('admin') && !Auth::is('commitee') && !Auth::is('staff') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $commitees = Commitee::with('user')->where('school_id', Auth::getSchool())->current()->get();
        return view('backEnd.commitee.info',compact('commitees'));
    }


    public function old_commitee()
    {
        if(!Auth::is('admin') && !Auth::is('commitee') && !Auth::is('staff') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $commitees = Commitee::with('user')->where('school_id', Auth::getSchool())->old()->get();
        $old = 1;
        return view('backEnd.commitee.info',compact('commitees','old'));
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
        $school = School::where('user_id', Auth::user()->id)
                ->select('schools.id as id')
                ->first();
        $designations = Designation::where('type',2)->get();
        return view('backEnd.commitee.add', compact('school','designations'));
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

        $this->validation($request);
        if($imageFile = $request->file('image')){
        $this->image=$this->imagesProcessing1($imageFile, 'commiteeImage',300,350);
        }
        $a='';
        try {
            DB::beginTransaction();
            $data = $request->except('password');
            $data['password'] = bcrypt($request->password);
            $user = User::create($data);
            $data['user_id'] = $user->id;
            $data['image'] = $this->image;
            $commitee=Commitee::create($data);
            $school=$this->school();
            if(isset($commitee->id) && $request->mobile!=NULL && $school->api_key!=NULL && $school->sender_id!=NULL){
               $school_name=$sms_send->school_name_process($school->user->name);
               $content='প্রিয় '.$request->name.' আপনার সফটওয়্যার লগইন তথ্য ! ওয়েব এড্রেস : '.$school->website.', ইমেইল : '.$request->email.', পাসওয়ার্ড : '.$request->password.'. '.$school_name;
               $message= urlencode($content);
               $mobile_number=$sms_send->validateNumber([0=>$request->mobile]);
               $mobile_number = implode(',',$mobile_number);
               $a = $this->sms_send_by_api($school,$mobile_number,$message);
            }
            DB::commit();
            Session::flash('sccmgs', 'কমিটি সফলভাবে যোগ করা হয়েছে !'.$a);
            return redirect()->back();

        } catch (\Exception $e){
            DB::rollback();
            if (file_exists($this->image)) {
                unlink($this->image);
            }
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Commitee $commitee)
    {
        return view('backEnd.commitee.show', compact('commitee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Commitee $commitee)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        //dd($id);
        $designations = Designation::where('type',2)->get();
        $commiteeData = Commitee::find($commitee->id);
        //echo $commiteeData;

        return view('backEnd.commitee.edit', compact('commiteeData','designations'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commitee $commitee)
    {
        if(!Auth::is('admin') && !Auth::is('commitee')){
            return redirect('/home');
        }
         if(Auth::is('admin')){
           $this->validationForUpdate($request, $commitee);
         }else{
            $this->validate($request,[
                'email'=>['required','string','email',Rule::unique('users','email')->ignore($commitee->user->id)],
            ]);
         }
        try {

            $data = $request->except('password');
            if($request->password){
              $data['password'] = bcrypt($request->password);
            }
            $user = User::find($commitee->user_id);;
            $user->update($data);

            if($imageFile = $request->file('image')){
                $this->image=$this->imagesProcessing1($imageFile, 'commiteeImage',300,350);
                if (file_exists(public_path(Storage::url($commitee->image)))){
                    Storage::delete($commitee->image);
                }
                $data['image'] = $this->image;
            }

            $commitee->update($data);
            Session::flash('sccmgs', 'কমিটি সফলভাবে আপডেট করা হয়েছে ।');
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে ! '.$e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Commitee $commitee)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }

        try {
            $this->image = $commitee->image;
            User::where('id', $commitee->user_id)->update(['deleted_at'=>Carbon::now()]);
            $commitee->update(['deleted_at'=>Carbon::now()]);
            Session::flash('sccmgs', 'কমিটি সফলভাবে মুছে ফেলা হয়েছে !');
            return redirect()->back();
        } catch (\Exception $e) {
                Session::flash('errmgs', 'সমস্যা হয়েছে !'.$e->getMessage());
                return redirect()->back();
        }



    }

    // commitee data validation here
    protected function validation(Request $data)
    {
        $this->validate($data, [
            'name'        => 'required|max:255',
            'gender'      => 'required',
            'designation_id' => 'required',
            'edu_quali' => 'required',
            'join_date' => 'required',
            'birth_date' => 'required',
            'religion' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'mobile'  => 'required|unique:users',
            'nid' => 'required',
            'village' => 'required',
            'post_office' => 'required',
            'unione' => 'required',
            'thana' => 'required',
            'district' => 'required',
            'post_code' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);
    }

    protected function validationForUpdate(Request $data, $commitee)
    {
        $this->validate($data, [
            'name'        => 'required|max:255',
            'gender'      => 'required',
            'designation_id' => 'required',
            'edu_quali' => 'required',
            'join_date' => 'required',
            'birth_date' => 'required',
            'religion' => 'required',
            'email' => ['required','string','email','max:255', Rule::unique('users', 'email')->ignore($commitee->user->id)],
            'password' => 'nullable|min:6',
            'mobile'  => ['required',Rule::unique('users', 'mobile')->ignore($commitee->user->id)],
            'nid' => 'required',
            'village' => 'required',
            'post_office' => 'required',
            'unione' => 'required',
            'thana' => 'required',
            'district' => 'required',
            'post_code' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);
    }


    public function profile()
    {
        if(!Auth::is('commitee')){
            return redirect('/home');
        }

        $commitee = Commitee::where(['user_id' => Auth::user()->id,'school_id' => Auth::getSchool()])->first();

        return view('backEnd.commitee.profile', compact('commitee'));

    }

    protected function editprofile()
    {
        if(!Auth::is('commitee')){
            return redirect('/home');
        }

        $id = Commitee::where('user_id', Auth::user()->id)->select(array('id'))->first();
        $commiteeData = Commitee::find($id->id);

        return view('backEnd.commitee.editProfile', compact('commiteeData'));
    }


}
