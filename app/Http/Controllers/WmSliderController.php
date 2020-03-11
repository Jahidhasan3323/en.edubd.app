<?php

namespace App\Http\Controllers;

use App\WmSlider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
class WmSliderController extends Controller
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
        $sliders=WmSlider::where('school_id', Auth::getSchool())->orderby('position','ASC')->get();
        return view('backEnd.webmanagement.slider.index',compact('sliders'));
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
        return view('backEnd.webmanagement.slider.add');
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
            'position' => 'required|numeric',
        ]);
        if($imageFile = $request->file('image')){
           $image_path=$this->imagesProcessing1($imageFile,'webmanagement/slider/',1220,450);
           $data['image'] = $image_path;

           
           
        }
        WmSlider::create($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmSlider  $wmSlider
     * @return \Illuminate\Http\Response
     */
    public function show(WmSlider $wmSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmSlider  $wmSlider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $slider=WmSlider::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        return view('backEnd.webmanagement.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmSlider  $wmSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         if(!Auth::is('admin')){
            return redirect('/home');
        }
       $data=$request->except('_token','_method');
       $wmSlider=WmSlider::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $this->validate($request, [
            'image' => 'mimes:jpg,png,gif,jpeg,svg|max:2048',
            'position' => 'required|numeric',
        ]);
        if($imageFile = $request->file('image')){
           $image_path=$this->imagesProcessing1($imageFile,'webmanagement/slider/',1220,450);
           $data['image'] = $image_path;
           if (isset($wmSlider->image)&&file_exists(public_path(Storage::url($wmSlider->image)))){
                Storage::delete($wmSlider->image);
            }
           
        }
        $wmSlider->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmSlider  $wmSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if (!Auth::is('admin')){
            return redirect('/home');
        }
        $wmSlider = WmSlider::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $wmSlider->delete();
        if (isset($wmSlider->image)&&file_exists(public_path(Storage::url($wmSlider->image)))){
                Storage::delete($wmSlider->image);
            }
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','slider');
    }
}
