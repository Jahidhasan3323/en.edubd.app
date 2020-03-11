<?php

namespace App\Http\Controllers;

use App\WmImportantLinksCategoryRoot;
use App\SchoolType;
use App\School;
use App\WmImportantLinksCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class WmImportantLinksCategoryRootController extends Controller
{
     public function index()
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $important_links_category_roots=WmImportantLinksCategoryRoot::orderby('id','DESC')->get();
        return view('backEnd.webmanagement.important_links_category_root.index',compact('important_links_category_roots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $school_types=SchoolType::all();
        return view('backEnd.webmanagement.important_links_category_root.add',compact('school_types'));
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
            'school_type_id' => 'required',
        ]);
       $school_type_id=implode("|",$request->school_type_id);
       $data['school_type_id']=$school_type_id;
        WmImportantLinksCategoryRoot::create($data);
        $schools=School::where('school_type_id',$school_type_id)->get();
        if ($schools) {
            foreach ($schools as $school) {
                WmImportantLinksCategory::insert(['tittle'=>$request->tittle,'school_id'=>$school->id]);
            }
        }
        
        return $this->returnWithSuccessRedirect('আপনার তথ্য সংরক্ষণ হয়েছে !','important_links_category_root');
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
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $school_types=SchoolType::all();
        $important_links_category_root=WmImportantLinksCategoryRoot::where(['id'=>$id])->first();
        return view('backEnd.webmanagement.important_links_category_root.edit',compact('important_links_category_root','school_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmImportantLinksCategory  $wmImportantLinksCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(!Auth::is('root')){
            return redirect('/home');
        }
       $data=$request->except('_token','_method');
       $important_links_category_root=WmImportantLinksCategoryRoot::where(['id'=>$id])->first();
        $this->validate($request, [
            'tittle' => 'required',
        ]);
        
        $important_links_category_root->update($data);
        return $this->returnWithSuccessRedirect('আপনার তথ্য পরিবর্তন হয়েছে !','important_links_category_root');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmImportantLinksCategory  $wmImportantLinksCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        $important_links_category_root = WmImportantLinksCategoryRoot::where(['id'=>$id])->first();
        $important_links_category_root->delete();
       
        return $this->returnWithSuccessRedirect('আপনার তথ্য মুছে দেওয়া হয়েছে ','important_links_category_root');
    }
}
