<?php

namespace App\Http\Controllers;

use App\WmImportantLinksRoot;
use App\WmImportantLinksCategoryRoot;
use App\WmImportantLinksCategory;
use App\WmImportantLink;
use App\SchoolType;
use App\School;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class WmImportantLinksRootController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $important_links=WmImportantLinksRoot::with('important_links_category_root')->orderby('id','DESC')->get();
        return view('backEnd.webmanagement.important_link_root.index',compact('important_links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categorys=WmImportantLinksCategoryRoot::orderby('id','DESC')->get();
         $school_types=SchoolType::all();
         
        return view('backEnd.webmanagement.important_link_root.add',compact('categorys','school_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(!Auth::is('root')){
            return redirect('/home');
        }
        $data=$request->all();

        $this->validate($request, [
            'tittle' => 'required',
            'link' => 'required',
            'wm_important_links_category_root_id' => 'required',
            'school_type_id' => 'required',
            'header_status' => 'required',
        ]);
       
        $school_type_id=implode("|",$request->school_type_id);
         $data['school_type_id']=$school_type_id;
        WmImportantLinksRoot::create($data);
        $schools=School::where('school_type_id',$school_type_id)->get();
        $wm_important_links_category_root=WmImportantLinksCategoryRoot::where('id',$request->wm_important_links_category_root_id)->value('tittle');
        $wm_important_links_category_id=WmImportantLinksCategory::where('tittle',$wm_important_links_category_root)->value('id');
        if ($schools) {
            foreach ($schools as $school) {
                WmImportantLink::insert(['tittle'=>$request->tittle,'link'=>$request->link,'wm_important_links_category_id'=>$wm_important_links_category_id,'school_id'=>$school->id]);
            }
        }
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','important_link_root');
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
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $categorys=WmImportantLinksCategoryRoot::orderby('id','DESC')->get();
        $important_link=WmImportantLinksRoot::where(['id'=>$id])->first();
        $school_types=SchoolType::all();
        return view('backEnd.webmanagement.important_link_root.edit',compact('important_link','categorys','school_types'));
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
        if(!Auth::is('root')){
            return redirect('/home');
        }
       $data=$request->except('_token','_method');
        $important_link=WmImportantLinksRoot::where(['id'=>$id])->first();
        $this->validate($request, [
            'tittle' => 'required',
            'link' => 'required',
            'wm_important_links_category_root_id' => 'required',
            'header_status' => 'required',
        ]);
       
        $important_link->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','important_link_root');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmImportantLink  $wmImportantLink
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        $important_link=WmImportantLinksRoot::where(['id'=>$id])->first();
        $important_link->delete();
        
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','important_link_root');
    }
}
