<?php

namespace App\Http\Controllers;

use App\OnlineAdmissionApplication;
use App\OnlineAdmissionAccademicInfo;
use App\OnlineAdmissionApplicationSubject;
use Illuminate\Http\Request;
use Validator;
class OnlineAdmissionApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return "abc";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return "cd";
        /*$validator = Validator::make($request->all(), [
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
            'name' => 'required',
            'exam_name' => 'required',
            'roll_no' => 'required',
            'reg_no' => 'required',
            'board' => 'required',
            'institute' => 'required',
            'passing_year' => 'required',
            'gpa' => 'required',
        ]);


        if ($validator->fails()) {
            return "no";
            //return back()->with("danger", "Something is wrong ");
        }*/
        
        if($imageFile = $request->file('picture')){
           $image_path=$this->imagesProcessing1($imageFile,'webmanagement/slider/',300,350);
           $data['picture'] = $image_path;
        }
        return $this->sendResponse('', 'Notice retrieved successfully.'); 
        $data=$request->all();
        $data['reg_no']=rand('10000','99999999');
        $data['password']=rand('10000','99999999');
        $data['type']=1;
         DB::beginTransaction();
         $check_phone=OnlineAdmissionApplication::where(['phone'=>$request->phone,'status'=>1])->first();
         if ($check_phone) {
             OnlineAdmissionApplication::where(['phone'=>$request->phone,'status'=>1])->update(['status'=>0]);
         }
         $application = OnlineAdmissionApplication::create($data);
         $data['o_a_application_id']=$application->id;
         $info = OnlineAdmissionAccademicInfo::create($data);
         foreach ($request->subject as $subject) {
            $subject = OnlineAdmissionApplicationSubject::create(['name'=>$subject,'type'=>2]);
         }
            $subject = OnlineAdmissionApplicationSubject::create(['name'=>$request->subject_optional,'type'=>3]);

            $subject = OnlineAdmissionApplicationSubject::create(['name'=>'বাংলা','type'=>1]);
            $subject = OnlineAdmissionApplicationSubject::create(['name'=>'ইংরেজি','type'=>1]);
            $subject = OnlineAdmissionApplicationSubject::create(['name'=>'তথ্য ও যোগাযোগ প্রযুক্তি','type'=>1]);
            

          return $this->sendResponse('', 'Notice retrieved successfully.'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OnlineAdmissionApplication  $onlineAdmissionApplication
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineAdmissionApplication $onlineAdmissionApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlineAdmissionApplication  $onlineAdmissionApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(OnlineAdmissionApplication $onlineAdmissionApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlineAdmissionApplication  $onlineAdmissionApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnlineAdmissionApplication $onlineAdmissionApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlineAdmissionApplication  $onlineAdmissionApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnlineAdmissionApplication $onlineAdmissionApplication)
    {
        //
    }
}
