<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class DesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::is('root')&&!Auth::is('admin')){
            return redirect('/home');
        }

        $designations = Designation::all();
        return view('backEnd.designations.info', compact('designations'));
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

        return view('backEnd.designations.add');
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

        $validator =Validator::make($request->all(), [
                   'name' => 'required|string|unique:designations',
                   'type' => 'required',
                     ]);

         if ($validator->fails()) {
             return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
         }

        $data['name'] = $request->name;
        $data['type'] = $request->type;
        if (Designation::create($data)){
            Session::flash('sccmgs', 'পদবী সফলভাবে যোগ করা হয়েছে !');
            return redirect()->back();
        }else{
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }

        return view('backEnd.designations.edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        $validator =Validator::make($request->all(), [
                   'name' => ['required','string', Rule::unique('designations', 'name')->ignore($designation->id)],
                   'name' => ['required'],
                     ]);

         if ($validator->fails()) {
             return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
         }


        $data = $request->only('name','type');
        if ($designation->update($data)){
            Session::flash('sccmgs', 'পদবী সফলভাবে আপডেট করা হয়েছে !');
            return redirect()->back();
        }else{
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }

        if ($designation->delete()){
            Session::flash('sccmgs', 'পদবী সফলভাবে মুছে ফেলা হয়েছে !');
            return redirect()->back();
        }else{
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !');
            return redirect()->back();
        }
    }
}
