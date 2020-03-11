<?php

namespace App\Http\Controllers;

use App\MasterClass;
use App\Subject;
use App\GroupClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\TriatContainer\SubjectValidation;
use Carbon\Carbon;

class SubjectController extends Controller
{
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
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $subjects = Subject::with('masterClass','groupClass')
                    ->where(['school_id'=>Auth::getSchool()])
                    ->groupBy(['master_class_id','group_class_id'])
                    ->selectRaw('master_class_id, group_class_id, count(id) as total_subject')->get();

        return view('backEnd.subjects.index', compact('subjects'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
       $master_classes = $this->getClasses();
       $group_classes = GroupClass::all();
       return view('backEnd.subjects.create', compact('group_classes','master_classes'));
    }

    protected function getClasses()
    {
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        return $classes;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $this->validate_check($request);
        $subject=Subject::where([
             'subject_name' =>$request->subject_name,
             'master_class_id'=>$request->master_class_id,
             'group_class_id'=>$request->group_class_id,
             'school_id'=>Auth::getSchool(),
         ])->first();
         if($subject){
             Session::flash('errmgs', 'দুঃখিত, বিষয় পূর্বেই যগ করা হয়েছে !');
             return redirect()->back();
         }

        try {
            $data = $request->all();
            $data['school_id'] = Auth::getSchool();
            Subject::create($data);
            return $this->returnWithSuccess('বিষয় সফলভাবে যোগ করা হয়েছে !');
        } catch (\Exception $e) {
            return $this->returnWithError('errmgs', 'দুঃখিত,  সমস্যা হয়েছে !'.$e->getMessage());
        }
    }

    protected function validate_check($request){
         $this->validate($request,[
             "subject_name"=>'required',
             "total_mark"=>'required',
             "total_pass_mark"=>'required',
             "status"=>'required',
             "subject_type"=>'required',
             "master_class_id"=>'required',
             "group_class_id"=>'required',
             "year"=>'required',
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($master_class_id, $group_class_id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $subjects = Subject::with('masterClass','groupClass')
                    ->where([
                        'school_id'=>Auth::getSchool(),
                        'master_class_id'=>$master_class_id,
                        'group_class_id'=>$group_class_id,
                    ])->get();
        return view('backEnd.subjects.show', compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
       $master_classes = $this->getClasses();
       $group_classes = GroupClass::all();
       $subject = Subject::where(['school_id'=>Auth::getSchool(),'id'=>$id])->first();
       return view('backEnd.subjects.edit', compact('group_classes','master_classes','subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $this->validate_check($request);
        $subject=Subject::where([
             'subject_name' =>$request->subject_name,
             'master_class_id'=>$request->master_class_id,
             'group_class_id'=>$request->group_class_id,
             'school_id'=>Auth::getSchool(),
         ])->first();
         if (isset($subject->id)&&$subject->id!=$id){
           Session::flash('errmgs', 'দুঃখিত, বিষয়টি পূর্বেই এসাইন করা হয়েছে !');
           return redirect()->back();
         }
        try {
            $data=$request->except('_token');
            Subject::where(['id'=>$id,'school_id'=>Auth::getSchool()])->update($data);
            Session::flash('sccmgs', 'বিষয় সফলভাবে আপডেট করা হয়েছে !');
            return redirect()->back();
        } catch (\Exception $e) {
           Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
           return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        try {
           Subject::where(['id'=>$id,'school_id'=>Auth::getSchool()])->forceDelete();
           Session::flash('sccmgs', 'বিষয় সফলভাবে মুছে ফেলা হয়েছে !');
           return redirect()->back();
        } catch (\Exception $e) {
           Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
           return redirect()->back();
        }
    }
}
