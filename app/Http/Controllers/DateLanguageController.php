<?php

namespace App\Http\Controllers;

use App\DateLanguage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
class DateLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if (!Auth::is('root')){
            return redirect('/home');
        }
         $date_languages = DateLanguage::orderBy('id', 'desc')->get();
       
        return view('backEnd.webmanagement.admin.date_lagnguage.index', compact('date_languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!Auth::is('root')){
            return redirect('/home');
        }

        return view('backEnd.webmanagement.admin.date_lagnguage.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        $data=$request->all();
         $validator=Validator::make($request->all(), [
                   'tittle' => 'required',
                   

           ]);;

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DateLanguage::create($data);
        Session::flash('sccmgs', 'আপনার তথ্য সংরক্ষণ হয়েছে ');
            return redirect('admin_date_language');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DateLanguage  $dateLanguage
     * @return \Illuminate\Http\Response
     */
    public function show(DateLanguage $dateLanguage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DateLanguage  $dateLanguage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $date_language=DateLanguage::where(['id'=>$id])->first();
        return view('backEnd.webmanagement.admin.date_lagnguage.edit',compact('date_language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DateLanguage  $dateLanguage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DateLanguage $dateLanguage,$id)
    {
        $data=$request->except('_token','_method');
        if (!Auth::is('root')){
            return redirect('/home');
        }

        
       $validator=Validator::make($request->all(), [
                   'tittle' => 'required',
                   

           ]);;

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        DateLanguage::where(['id'=>$id])->update($data);
            Session::flash('sccmgs', 'আপনার তথ্য পরিবর্তন হয়েছে ');
            return redirect('admin_date_language');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DateLanguage  $dateLanguage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if (!Auth::is('root')){
            return redirect('/home');
        }
        $date_language = DateLanguage::withTrashed()->where('id', $id)->first();
        $date_language->delete();
        //DateLanguage::find($id)->delete();
        Session::flash('sccmgs', 'আপনার তথ্য মুছে দেওয়া হয়েছে ');
            return redirect('admin_date_language');

    }
}
