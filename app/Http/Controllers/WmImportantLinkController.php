<?php

namespace App\Http\Controllers;

use App\WmImportantLink;
use App\School;
use App\WmImportantLinksCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class WmImportantLinkController extends Controller
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
        $important_links=WmImportantLink::with('important_links_category')->where('school_id', Auth::getSchool())->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.important_link.index',compact('important_links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categorys=WmImportantLinksCategory::where(['school_id'=> Auth::getSchool()])->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.important_link.add',compact('categorys'));
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
            'link' => 'required',
            'wm_important_links_category_id' => 'required',
        ]);
       
        WmImportantLink::create($data);
         
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','important_link');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmImportantLink  $wmImportantLink
     * @return \Illuminate\Http\Response
     */
    public function show(WmImportantLink $wmImportantLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmImportantLink  $wmImportantLink
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $categorys=WmImportantLinksCategory::where(['school_id'=> Auth::getSchool()])->orderby('id','DESC')->get();
        $important_link=WmImportantLink::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        return view('backEnd.webmanagement.important_link.edit',compact('important_link','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmImportantLink  $wmImportantLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
       $data=$request->except('_token','_method');
        $important_link=WmImportantLink::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $this->validate($request, [
            'tittle' => 'required',
            'link' => 'required',
            'wm_important_links_category_id' => 'required',
        ]);
       
        $important_link->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','important_link');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmImportantLink  $wmImportantLink
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $important_link=WmImportantLink::where(['id'=>$id,'school_id'=> Auth::getSchool()])->first();
        $important_link->delete();
        
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','important_link');
    }
}
