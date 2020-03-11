<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ExamType;
use App\ImportantSetting;

class ImportantSettingController extends Controller
{
    private $imp_setting;
    private $exam_type;
    public function __construct(){
       $this->imp_setting=new ImportantSetting();
       $this->exam_type=new ExamType();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imp_setting=$this->imp_setting->where('school_id',Auth::getSchool())->first();;
        $exam_types=$this->exam_type->all();
        return view('backEnd.importantSetting.index', compact('imp_setting','exam_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imp_setting=$this->imp_setting->where('school_id',Auth::getSchool())->first();
        try{
            if($imp_setting){
                $data=$request->except('_token','class_position_identify');
                if($request->class_position_identify){
                $data['class_position_identify']=implode('|',$request->class_position_identify);
                $imp_setting->update($data);
                }else{
                    $data['class_position_identify']=null;
                    $imp_setting->update($data);
                }
            }else{
                $data=$request->except('class_position_identify');
                if($request->class_position_identify){
                $data['class_position_identify']=implode('|',$request->class_position_identify);
                $this->imp_setting->create($data);
                }else{
                    $data['class_position_identify']=null;
                    $imp_setting->create($data);
                }
            }
            return $this->returnWithSuccess('সফলভাবে পরিবর্তন করা হয়েছে !');
        }catch (\Exception $e) {
            return $this->returnWithError('দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
        }
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
