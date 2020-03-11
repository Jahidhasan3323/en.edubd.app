<?php

namespace App\Http\Controllers;

use App\ClassRoutine;
use App\SchoolClass;
use Illuminate\CustomClasses\Get;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\GroupClass;

class ClassRoutineController extends Controller
{
    protected $photo = null;

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function redirectIfExpired()
    {
        if (Get::expiry() < 0){
            return true;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if ($this->redirectIfExpired()){
            return redirect('/home');
        }

        if (Auth::is('admin')){
            $data=['school_id'=> Auth::getSchool()];
        }else{
           $data=['status'=>1, 'school_id'=> Auth::getSchool()];
        }
        $routines = ClassRoutine::where($data)
                    ->orderBy('master_class_id')
                    ->get();
        return view('backEnd.routines.classRoutine_info', compact('routines'));
    }

    public function statusControl($id, $status)
    {
      if($status==0){
        ClassRoutine::where(['id'=>$id,'school_id'=>Auth::getSchool()])->update(['status'=>1]);
      }else{
        ClassRoutine::where(['id'=>$id,'school_id'=>Auth::getSchool()])->update(['status'=>0]);
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
        if ($this->redirectIfExpired()){
            return redirect('/home');
        }

        $classes = $this->getClasses();
        $group_classes=GroupClass::all();
        return view('backEnd.routines.add_class_routin', compact('classes','group_classes'));
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
        if ($this->redirectIfExpired()){
            return redirect('/home');
        }

        $this->validate($request, [
            'master_class_id' => 'required',
            'name' => 'required',
            'routine' => 'required|mimes:pdf',
        ]);


        $old_routine = ClassRoutine::where([
            'school_id'=> Auth::getSchool(),
            'master_class_id'=> $request->master_class_id,
        ])->first();
        $file = $request->file('routine');
        $file_size = $file->getClientSize();
        if ($file_size > 512000){
            Session::flash('errmgs', 'দুঃখিত, ফাইলটি অনেক বড় !');
            return redirect()->back();
        }
        $extension = $file->getClientOriginalExtension();
        $filenametostore ='-'.Str::random(30).'.'.$extension;
        $this->photo=$file->storeAs('public/routines/',$filenametostore);

        /*
         * | for file update .............
         */

        if ($old_routine){
            if (file_exists(public_path(Storage::url($old_routine->path)))){
                Storage::delete($old_routine->path);
            }
            try {
                $old_routine->path = $this->photo;
                $old_routine->name = $request->name;
                $old_routine->master_class_id = $request->master_class_id;
                $old_routine->save();
                Session::flash('sccmgs', 'ক্লাস রুটিন সফলভাবে যোগ করা হয়েছে !');
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
            $classRoutine = new ClassRoutine();
            $classRoutine->school_id = Auth::getSchool();
            $classRoutine->master_class_id = $request->master_class_id;
            $classRoutine->name = $name;
            $classRoutine->path = $this->photo;
            $classRoutine->save();
            Session::flash('sccmgs', 'ক্লাস রুটিন সফলভাবে যোগ করা হয়েছে !');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $classes=$this->getClasses();
        $group_classes=GroupClass::all();
        $routine=ClassRoutine::where(['id'=>$id, 'school_id'=>Auth::getSchool()])->first();

        $explode=explode('/', $routine->path);
        end($explode);
        $key = key($explode);
        $file_name = $explode[$key];
        return view('backEnd.routines.edit_class_routine',compact('classes','routine','file_name','group_classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassRoutine  $classRoutine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        if ($this->redirectIfExpired()){
            return redirect('/home');
        }

        $this->validate($request, [
            'master_class_id' => 'required',
            'name' => 'required',
            'routine' => 'nullable|mimes:pdf',
        ]);

        $data['master_class_id']=$request->master_class_id;
        $data['name']=$request->name;
        $old_routine = ClassRoutine::where(['id'=>$request->routine_id, 'school_id'=>Auth::getSchool()])->first();

           if($file = $request->file('routine')){
             $file_size = $file->getClientSize();
             if ($file_size > 512000){
               Session::flash('errmgs', 'দুঃখিত, ফাইল সাইজ আরো ছোট হতে হবে !');
               return redirect()->back();
             }


           $extension = $file->getClientOriginalExtension();
           $filenametostore ='-'.Str::random(30).'.'.$extension;
           $this->photo=$file->storeAs('public/routines/',$filenametostore);
           $data['path']=$this->photo;
           if (file_exists(public_path(Storage::url($old_routine->path)))){
               Storage::delete($old_routine->path);
           }
        }


        if($old_routine->master_class_id!=$request->master_class_id){
            $old_routine = ClassRoutine::where([
                'master_class_id'=>$request->master_class_id,
                'school_id'=>Auth::getSchool()
            ])->first();
            if($old_routine){
               Session::flash('errmgs', 'দুঃখিত, আপনার নির্বাচিত শ্রেণী পূর্বেই প্রকাশিত হয়েছে।!');
               return redirect()->back();
            }
        }
        ClassRoutine::where(['id'=>$request->routine_id,'school_id'=>Auth::getSchool()])->update($data);
        Session::flash('sccmgs', 'Successfully updated !');
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassRoutine  $classRoutine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $old_routine=ClassRoutine::where(['id'=>$id,'school_id'=>Auth::getSchool()])->select('path')->first();
      if (file_exists($old_routine->path)){
           unlink($old_routine->path);
      }
        ClassRoutine::where(['id'=>$id,'school_id'=>Auth::getSchool()])->delete();
        Session::flash('sccmgs', 'This routine Successfully deleted !');
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
