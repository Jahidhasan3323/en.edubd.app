<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Storage;
use Illuminate\Support\Str;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected $notice = null;
    protected $oldNotice = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::is('admin')){
           $data=['school_id'=>Auth::getSchool()];
        }else{
           $data=['status'=>1,'school_id'=>Auth::getSchool()];
        }
        $notices = Notice::where($data)->orderBy('id', 'desc')->get();

        return view('backEnd.notices.info', compact('notices'));
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

        return view('backEnd.notices.add');
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

        $this->validate($request, [
            'name' => 'required',
            'notice' => 'nullable|mimes:pdf',
        ]);
        $data = $request->all();

        $notice = $request->file('notice');

        try {
            $noticeObject = new Notice();
            if($notice){
            $file_size = $notice->getClientSize();
            if ($file_size > 512000){
                Session::flash('errmgs', 'দুঃখিত, ফাইল সাইজ আরো ছোট হতে হবে !');
                return redirect()->back();
            }
              $extension = $notice->getClientOriginalExtension();
              $filenametostore ='-'.Str::random(30).'.'.$extension;
              $this->notice =$notice->storeAs('public/notices/',$filenametostore);
              $noticeObject->path = $this->notice;
            }
            $noticeObject->name = $request->name;
            $noticeObject->description = $request->description;
            $noticeObject->is_admission_notice = $request->is_admission_notice;
            $noticeObject->school_id = Auth::getSchool();
            $noticeObject->status = 0;
            $noticeObject->save();


            Session::flash('sccmgs', 'নোটিশ সফলভাবে যোগ করা হয়েছে !');
            return redirect('notice');
        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect('notice');
        }
    }


    public function status($id, $status)
    {
        if($status==0){
           Notice::where(['id'=>$id,'school_id'=>Auth::getSchool()])->update(['status'=>1]);
        }else{
           Notice::where(['id'=>$id,'school_id'=>Auth::getSchool()])->update(['status'=>0]);
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice=Notice::where(['id'=>$id, 'school_id'=>Auth::getSchool()])->first();
        $explode=explode('/', $notice->path);
        end($explode);
        $key = key($explode);
        $file_name = $explode[$key];
        return view('backEnd.notices.view',compact('notice','file_name'));
    }
    public function edit($id)
    {
        $notice=Notice::where(['id'=>$id, 'school_id'=>Auth::getSchool()])->first();
        $explode=explode('/', $notice->path);
        end($explode);
        $key = key($explode);
        $file_name = $explode[$key];
        return view('backEnd.notices.edit',compact('notice','file_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        $this->validate($request, [
            'name' => 'required',
            'notice' => 'nullable|mimes:pdf',
        ]);
        $data['name']=$request->name;
        $data['description']=$request->description;
        $data['is_admission_notice']=$request->is_admission_notice;

        $old_notice = Notice::where(['id'=>$request->notice_id, 'school_id'=>Auth::getSchool()])->first();

            if($notice = $request->file('notice')){
                $file_size = $notice->getClientSize();
                if ($file_size > 512000){
                  Session::flash('errmgs', 'দুঃখিত, ফাইল সাইজ আরো ছোট হতে হবে !');
                  return redirect()->back();
                }
                $extension = $notice->getClientOriginalExtension();
                $filenametostore ='-'.Str::random(30).'.'.$extension;
                if(file_exists(public_path(Storage::url($old_notice->path)))){
                    Storage::delete($old_notice->path);
                }
                $data['path']=$notice->storeAs('public/notices/',$filenametostore);
            }

            Notice::where(['id'=>$request->notice_id, 'school_id'=>Auth::getSchool()])->update($data);
            Session::flash('sccmgs', 'নোটিশ সফলভাবে আপডেট করা হয়েছে !');
            return redirect('notice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }

        try {
            $oldNotce = Notice::find($id);
            $this->oldNotice = $oldNotce->path;
            $oldNotce->delete();
            if (file_exists($this->oldNotice)){
                unlink($this->oldNotice);
            }

            Session::flash('sccmgs', 'নোটিশ সফলভাবে মুছে ফেলা হয়েছে !');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }
}
