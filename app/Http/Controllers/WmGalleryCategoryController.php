<?php

namespace App\Http\Controllers;

use App\WmGalleryCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class WmGalleryCategoryController extends Controller
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
        $gallery_categorys=WmGalleryCategory::where('school_id', Auth::getSchool())->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.gallery_category.index',compact('gallery_categorys'));
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
        return view('backEnd.webmanagement.gallery_category.add');
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
            'tittle' => 'required',
            'type' => 'required',
        ]);
        
        WmGalleryCategory::create($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','gallery_category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmGalleryCategory  $wmGalleryCategory
     * @return \Illuminate\Http\Response
     */
    public function show(WmGalleryCategory $wmGalleryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmGalleryCategory  $wmGalleryCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $gallery_category=WmGalleryCategory::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        return view('backEnd.webmanagement.gallery_category.edit',compact('gallery_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmGalleryCategory  $wmGalleryCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
       $data=$request->except('_token','_method');
       $gallery_category=WmGalleryCategory::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $this->validate($request, [
            'tittle' => 'required',
            'type' => 'required',
        ]);
        
        $gallery_category->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য পরিবর্তন হয়েছে !','gallery_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmGalleryCategory  $wmGalleryCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if (!Auth::is('admin')){
            return redirect('/home');
        }
        $gallery_category = WmGalleryCategory::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $gallery_category->delete();
       
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','gallery_category');
    }
}
