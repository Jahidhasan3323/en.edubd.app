<?php

namespace App\Http\Controllers;

use App\WmDateLanguage;
use App\DateLanguage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
class WmDateLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       if(!Auth::is('admin')){
            return redirect('/home');
        }
         $date_languages =WmDateLanguage::where('school_id', Auth::getSchool())->get();
        return view('backEnd.webmanagement.admin.wmdate_lagnguage.index',compact('date_languages'));
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
        $date_languages = DateLanguage::orderBy('id', 'desc')->get();
        return view('backEnd.webmanagement.admin.wmdate_lagnguage.add',compact('date_languages'));
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
        $data=$request->all();
         $validator=Validator::make($request->all(), [
                   'date_language_id' => 'required',
                   

           ]);;

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data['school_id']=Auth::getSchool();

        WmDateLanguage::create($data);
        Session::flash('sccmgs', 'আপনার তথ্য সংরক্ষণ হয়েছে ');
            return redirect('date_language');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmDateLanguages  $wmDateLanguages
     * @return \Illuminate\Http\Response
     */
    public function show(WmDateLanguages $wmDateLanguages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmDateLanguages  $wmDateLanguages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if (!Auth::is('admin')){
            return redirect('/home');
        }
         $date_languages = DateLanguage::orderBy('id', 'desc')->get();
        $date_language1 = WmDateLanguage::where('id',$id)->first();
        return view('backEnd.webmanagement.admin.wmdate_lagnguage.edit',compact('date_languages','date_language1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmDateLanguages  $wmDateLanguages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $data=$request->except('_token','_method');
         $validator=Validator::make($request->all(), [
                   'date_language_id' => 'required',
                   

           ]);;

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        WmDateLanguage::where(['id'=>$id, 'school_id'=> Auth::getSchool()])->update($data);
        Session::flash('sccmgs', 'আপনার তথ্য পরিবর্তন হয়েছে ');
            return redirect('date_language');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmDateLanguages  $wmDateLanguages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::is('admin')){
            return redirect('/home');
        }
        $date_language = WmDateLanguage::withTrashed()->where('id', $id)->first();
        $date_language->delete();
        //DateLanguage::find($id)->delete();
        Session::flash('sccmgs', 'আপনার তথ্য মুছে দেওয়া হয়েছে ');
            return redirect('date_language');

    }
}
