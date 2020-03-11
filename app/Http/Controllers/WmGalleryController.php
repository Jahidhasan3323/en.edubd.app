<?php

namespace App\Http\Controllers;

use App\WmGallery;
use App\WmGalleryCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
class WmGalleryController extends Controller
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
        $image_gallerys=WmGallery::with('gallery_category')->where(['type'=>1,'school_id'=> Auth::getSchool()])->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.image.index',compact('image_gallerys'));
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
         $categorys=WmGalleryCategory::where(['type'=>1,'school_id'=> Auth::getSchool()])->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.image.add',compact('categorys'));
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
            'path' => 'required|mimes:jpg,png,gif,jpeg,svg|max:2048',
            'type' => 'required',
            'wm_gallery_category_id' => 'required',
        ]);
        
        if($imageFile = $request->file('path')){
           $image_path=$this->imagesProcessing1($imageFile,'webmanagement/imageGallery/',850,350);
           $data['path'] = $image_path;
        }
        if($date = $request->date){
            $data['date']=date_format(date_create($request->date),"Y-m-d");
        }
        
        WmGallery::create($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','image_gallery');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\WmGallery  $wmGallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $image_gallery=WmGallery::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        return view('backEnd.webmanagement.image.view',compact('image_gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmGallery  $wmGallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
         $categorys=WmGalleryCategory::where(['type'=>1,'school_id'=> Auth::getSchool()])->orderby('id','DESC')->get();
         $image_gallery=WmGallery::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        return view('backEnd.webmanagement.image.edit',compact('categorys','image_gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmGallery  $wmGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }

       $data=$request->all();
        $image_gallery=WmGallery::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();

        $this->validate($request, [
            'path' => 'mimes:jpg,png,gif,jpeg,svg|max:2048',
            'type' => 'required',
            'wm_gallery_category_id' => 'required',
        ]);
        
        if($imageFile = $request->file('path')){
           $image_path=$this->imagesProcessing1($imageFile,'webmanagement/imageGallery/',850,350);
           $data['path'] = $image_path;
           if (isset($image_gallery->path)&&file_exists(public_path(Storage::url($image_gallery->path)))){
                Storage::delete($image_gallery->path);
            }
        }
        if($date = $request->date){
            $data['date']=date_format(date_create($request->date),"Y-m-d");
        }


        $image_gallery->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','image_gallery');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmGallery  $wmGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $image_gallery=WmGallery::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $image_gallery->delete();
        if (isset($image_gallery->path)&&file_exists(public_path(Storage::url($image_gallery->path)))){
                Storage::delete($image_gallery->path);
            }
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','image_gallery');
    }

//video
    public function video()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $video_gallerys=WmGallery::where(['type'=>2,'school_id'=> Auth::getSchool()])->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.video.index',compact('video_gallerys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVideo()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
         $categorys=WmGalleryCategory::where(['type'=>2,'school_id'=> Auth::getSchool()])->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.video.add',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVideo(Request $request)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }

       $data=$request->all();

        $this->validate($request, [
            'path' => 'required',
            'type' => 'required',
            'wm_gallery_category_id' => 'required',
        ]);
        
        
        if($date = $request->date){
            $data['date']=date_format(date_create($request->date),"Y-m-d");
        }
        
        WmGallery::create($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','video_gallery');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\WmGallery  $wmGallery
     * @return \Illuminate\Http\Response
     */
    public function showVideo($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $video_gallery=WmGallery::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        return view('backEnd.webmanagement.video.view',compact('video_gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmGallery  $wmGallery
     * @return \Illuminate\Http\Response
     */
    public function editVideo($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
         $categorys=WmGalleryCategory::where(['type'=>2,'school_id'=> Auth::getSchool()])->orderby('id','DESC')->get();
         $video_gallery=WmGallery::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        return view('backEnd.webmanagement.video.edit',compact('categorys','video_gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmGallery  $wmGallery
     * @return \Illuminate\Http\Response
     */
    public function updateVideo(Request $request, $id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }

       $data=$request->all();
        $image_gallery=WmGallery::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();

        $this->validate($request, [
            'path' => 'required',
            'type' => 'required',
            'wm_gallery_category_id' => 'required',
        ]);
        
        
        if($date = $request->date){
            $data['date']=date_format(date_create($request->date),"Y-m-d");
        }


        $image_gallery->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','video_gallery');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmGallery  $wmGallery
     * @return \Illuminate\Http\Response
     */
    public function destroyVideo($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $image_gallery=WmGallery::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $image_gallery->delete();
       
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','video_gallery');
    }
}
