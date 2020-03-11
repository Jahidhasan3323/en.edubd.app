<?php

namespace App\Http\Controllers;

use App\ExamRoutine;
use App\ExamType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\GroupClass;
class ExamRoutineController extends Controller
{
    protected $photo = null;

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
        if (Auth::is('admin')){
            $data=['school_id'=> Auth::getSchool()];
        }else{
           $data=['status'=>1, 'school_id'=> Auth::getSchool()];
        }
        $routines = ExamRoutine::where($data)
                    ->orderBy('master_class_id')
                    ->get();
        return view('backEnd.routines.examRoutine_info', compact('routines'));
    }

    public function statusControl($id, $status)
    {
      if($status==0){
        ExamRoutine::where(['id'=>$id,'school_id'=>Auth::getSchool()])->update(['status'=>1]);
      }else{
        ExamRoutine::where(['id'=>$id,'school_id'=>Auth::getSchool()])->update(['status'=>0]);
      }
      return redirect()->back();
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
        $exams = ExamType::all();
        $classes = $this->getClasses();
        return view('backEnd.routines.add_exam_routine', compact('classes', 'exams'));
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
        $this->validate($request,[
            'master_class_id' => 'required',
            'name' => 'required',
            'routine' => 'required|mimes:pdf',
            'exam_type_id' => 'required',
        ]);

        $old_routine = ExamRoutine::where([
            'school_id'=>Auth::getSchool(),
            'master_class_id'=> $request->master_class_id,
            'exam_type_id'=> $request->exam_type_id,
        ])->first();

        $file = $request->file('routine');
        $extension = $file->getClientOriginalExtension();
        $filenametostore ='-'.Str::random(30).'.'.$extension;
        $this->photo=$file->storeAs('public/routines/',$filenametostore);
        $data['path']=$this->photo;

        /*
         * | for file update .............
         */
        if ($old_routine){
            if (file_exists(public_path(Storage::url($old_routine->path)))){
               Storage::delete($old_routine->path);
            }

            try {
                $old_routine->path = $this->photo;
                $old_routine->master_class_id = $request->master_class_id;
                $old_routine->exam_type_id = $request->exam_type_id;
                $old_routine->name =$request->name;
                $old_routine->save();

                Session::flash('sccmgs', 'পরীক্ষার সময়সুচি সফলভাবে যোগ করা হয়েছে !');
                return redirect()->back();
            } catch (\Exception $e) {
                Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
                return redirect()->back();
            }
        }

        /*
        | for file first time insert ........
        */
        try {
            $examRoutine = new ExamRoutine();
            $examRoutine->school_id =Auth::getSchool();
            $examRoutine->master_class_id = $request->master_class_id;
            $examRoutine->exam_type_id = $request->exam_type_id;
            $examRoutine->name = $request->name;
            $examRoutine->path = $this->photo;
            $examRoutine->save();

            Session::flash('sccmgs', 'পরীক্ষার সময়সূচি সফলভাবে যোগ করা হয়েছে !');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamRoutine  $examRoutine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $exams =ExamType::all();
        $classes = $this->getClasses();
        $routine=ExamRoutine::where(['id'=>$id, 'school_id'=> Auth::getSchool()])->first();
        $explode=explode('/', $routine->path);
        end($explode);
        $key = key($explode);
        $file_name = $explode[$key];
        return view('backEnd.routines.edit_exam_routine', compact('classes', 'exams','routine','file_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamRoutine  $examRoutine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $this->validate($request, [
            'master_class_id' => 'required',
            'exam_type_id' => 'required',
            'name' => 'required',
            'routine' => 'nullable|mimes:pdf',
        ]);
        $data['master_class_id']=$request->master_class_id;
        $data['exam_type_id']=$request->exam_type_id;
        $data['name']=$request->name;
        $old_routine = ExamRoutine::where(['id'=>$request->routine_id, 'school_id'=>Auth::getSchool()])->first();
        if($file = $request->file('routine')){
           $file_size = $file->getClientSize();
           if ($file_size > 512000){
               Session::flash('errmgs', 'দুঃখিত, ফাইল সাইজ আরো কম হতে হবে !');
               return redirect()->back();
           }
                $file = $request->file('routine');
                $extension = $file->getClientOriginalExtension();
                $filenametostore ='-'.Str::random(30).'.'.$extension;
                $this->photo=$file->storeAs('public/routines/',$filenametostore);
                $data['path']=$this->photo;
           if (file_exists(public_path(Storage::url($old_routine->path)))){
               Storage::delete($old_routine->path);
           }
        }

       if($old_routine->master_class_id!=$request->master_class_id){
           $old_routine = ExamRoutine::where([
            'master_class_id'=>$request->master_class_id,
            'exam_type_id'=>$request->exam_type_id,
            'school_id'=>Auth::getSchool()
         ])->first();
           if($old_routine){
              Session::flash('errmgs', 'দুঃখিত, আপনার শ্রেণী পূর্বেই প্রকাশিত হয়েছে !');
              return redirect()->back();
           }
       }
       ExamRoutine::where(['id'=>$request->routine_id,'school_id'=>Auth::getSchool()])->update($data);
       Session::flash('sccmgs', 'সফলভাবে আপডেট হয়েছে !');
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamRoutine  $examRoutine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old_routine=ExamRoutine::where(['id'=>$id,'school_id'=>Auth::getSchool()])->select('path')->first();
        if (file_exists($old_routine->path)){
             unlink($old_routine->path);
        }
        ExamRoutine::where(['id'=>$id,'school_id'=>Auth::getSchool()])->delete();
        Session::flash('sccmgs', 'রুটিনটি সফলভাবে মুছে ফেলা হয়েছে !');
        return redirect()->back();
    }

    protected function getClasses()
    {
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = DB::table('master_classes')
            ->select(array('id','name as class'))
            ->whereIn('school_type_id', $school_type_ids)
            ->get();

        return $classes;
    }
}
