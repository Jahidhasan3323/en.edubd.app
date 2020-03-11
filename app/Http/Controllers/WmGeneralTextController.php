<?php

namespace App\Http\Controllers;

use App\WmGeneralText;
use App\WmGeneralTextType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
class WmGeneralTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $general_texts=WmGeneralText::with('general_text_type')->where('school_id', Auth::getSchool())->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.general_text.index',compact('general_texts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
         $types=WmGeneralTextType::orderby('id','DESC')->get();
        return view('backEnd.webmanagement.general_text.add',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
       $data=$request->all();

        $this->validate($request, [
            'file' => 'mimes:jpg,png,gif,jpeg,svg,pdf|max:2048',
            'wm_general_text_type_id' => 'required',
        ]);
        if($request->file('file')){
            $extension = $request->file('file')->getClientOriginalExtension();
            $notice_name = explode(' ', $request->name);
            $notice_name = implode('_', $notice_name).time();
            $to_uploaded_name = $notice_name . '.' . $extension;
            $to_uploaded_path = 'public/generalFile/';
            $data['file'] = $to_uploaded_path . $to_uploaded_name;
             $request->file('file')->storeAs($to_uploaded_path, $to_uploaded_name);
        }
            WmGeneralText::create($data);
            return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','general_text');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmGeneralText  $wmGeneralText
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
         $general_text=WmGeneralText::where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
        return view('backEnd.webmanagement.general_text.view',compact('general_text'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmGeneralText  $wmGeneralText
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
         $types=WmGeneralTextType::orderby('id','DESC')->get();
         $general_text=WmGeneralText::where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
        return view('backEnd.webmanagement.general_text.edit',compact('general_text','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmGeneralText  $wmGeneralText
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $data=$request->except('_token','_method');

        $this->validate($request, [
            'file' => 'mimes:jpg,png,gif,jpeg,svg,pdf|max:2048',
            'wm_general_text_type_id' => 'required',
        ]);
        $wmGeneralText = WmGeneralText::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        if($request->file('file')){
            $extension = $request->file('file')->getClientOriginalExtension();
            $notice_name = explode(' ', $request->name);
            $notice_name = implode('_', $notice_name).time();
            $to_uploaded_name = $notice_name . '.' . $extension;
            $to_uploaded_path = 'public/generalFile/';
            $data['file'] = $to_uploaded_path . $to_uploaded_name;
             $request->file('file')->storeAs($to_uploaded_path, $to_uploaded_name);

             if (isset($wmGeneralText->file)&&file_exists(public_path(Storage::url($wmGeneralText->file)))){
                Storage::delete($wmGeneralText->file);
            }
        }
            $wmGeneralText->update($data);
            return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','general_text');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmGeneralText  $wmGeneralText
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $wmGeneralText = WmGeneralText::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $wmGeneralText->delete();
        if (isset($wmGeneralText->file)&&file_exists(public_path(Storage::url($wmGeneralText->file)))){
                Storage::delete($wmGeneralText->file);
            }
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','general_text');
    }
}
