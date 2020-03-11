<?php

namespace App\Http\Controllers;

use App\WmImportantLinksCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class WmImportantLinksCategoryController extends Controller
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
        $important_links_categorys=WmImportantLinksCategory::with('important_links')->where('school_id', Auth::getSchool())->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.important_links_category.index',compact('important_links_categorys'));
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
        return view('backEnd.webmanagement.important_links_category.add');
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
        ]);
        
        WmImportantLinksCategory::create($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','important_links_category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmImportantLinksCategory  $wmImportantLinksCategory
     * @return \Illuminate\Http\Response
     */
    public function show(WmImportantLinksCategory $wmImportantLinksCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmImportantLinksCategory  $wmImportantLinksCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $important_links_category=WmImportantLinksCategory::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        return view('backEnd.webmanagement.important_links_category.edit',compact('important_links_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmImportantLinksCategory  $wmImportantLinksCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(!Auth::is('admin')){
            return redirect('/home');
        }
       $data=$request->except('_token','_method');
       $important_links_category=WmImportantLinksCategory::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $this->validate($request, [
            'tittle' => 'required',
        ]);
        
        $important_links_category->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য পরিবর্তন হয়েছে !','important_links_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmImportantLinksCategory  $wmImportantLinksCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $important_links_category = WmImportantLinksCategory::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $important_links_category->delete();
       
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','important_links_category');
    }
}
