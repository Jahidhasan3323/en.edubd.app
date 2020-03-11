<?php

namespace App\Http\Controllers;

use App\WmSpeech;
use App\WmSpeechType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
class WmSpeechController extends Controller
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
        $speechs=WmSpeech::with('speech_type')->where('school_id', Auth::getSchool())->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.speech.index',compact('speechs'));
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
         $types=WmSpeechType::orderby('id','DESC')->get();
        return view('backEnd.webmanagement.speech.add',compact('types'));
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
            'image' => 'required|mimes:jpg,png,gif,jpeg,svg|max:2048',
            'tittle' => 'required',
            'speech' => 'required',
            'type_id' => 'required',
            'position' => 'required|numeric',
        ]);
        if($request->type_id==3){
            if($imageFile = $request->file('image')){
               $image_path=$this->imagesProcessing1($imageFile,'webmanagement/speech/',850,195);
               $data['image'] = $image_path;
            }
        }else{
           if($imageFile = $request->file('image')){
               $image_path=$this->imagesProcessing1($imageFile,'webmanagement/speech/',130,135);
               $data['image'] = $image_path;
            } 
        }
        WmSpeech::create($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','speech');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmSpeech  $wmSpeech
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if(!Auth::is('admin')){
            return redirect('/home');
        }
         $speech=WmSpeech::where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
        return view('backEnd.webmanagement.speech.view',compact('speech'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmSpeech  $wmSpeech
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        if(!Auth::is('admin')){
            return redirect('/home');
        }
         $speech=WmSpeech::where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
         $types=WmSpeechType::orderby('id','DESC')->get();
        return view('backEnd.webmanagement.speech.edit',compact('types','speech'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmSpeech  $wmSpeech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         if(!Auth::is('admin')){
            return redirect('/home');
        }
       $data=$request->except('_token','_method');
    $wmSpeech=WmSpeech::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $this->validate($request, [
            'image' => 'mimes:jpg,png,gif,jpeg,svg|max:2048',
            'tittle' => 'required',
            'speech' => 'required',
            'type_id' => 'required',
            'position' => 'required|numeric',
        ]);
        if($request->type_id==3){
            if($imageFile = $request->file('image')){
               $image_path=$this->imagesProcessing1($imageFile,'webmanagement/speech/',850,195);
               $data['image'] = $image_path;
               if (isset($wmSpeech->image)&&file_exists(public_path(Storage::url($wmSpeech->image)))){
                Storage::delete($wmSpeech->image);
                }
            }
            
        }else{
           if($imageFile = $request->file('image')){
               $image_path=$this->imagesProcessing1($imageFile,'webmanagement/speech/',130,135);
               $data['image'] = $image_path;
               if (isset($wmSpeech->image)&&file_exists(public_path(Storage::url($wmSpeech->image)))){
                Storage::delete($wmSpeech->image);
            } 
            }

        }
        $wmSpeech->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য পরিবর্তন হয়েছে !','speech');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmSpeech  $wmSpeech
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if (!Auth::is('admin')){
            return redirect('/home');
        }
        $wmSpeech = WmSpeech::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $wmSpeech->delete();
        if (isset($wmSpeech->image)&&file_exists(public_path(Storage::url($wmSpeech->image)))){
                Storage::delete($wmSpeech->image);
            }
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','speech');
    }
}
