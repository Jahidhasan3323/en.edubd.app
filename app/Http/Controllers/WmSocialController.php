<?php

namespace App\Http\Controllers;

use App\WmSocial;
use App\WmSchool;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class WmSocialController extends Controller
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
        $link=WmSocial::where('school_id', Auth::getSchool())->first();
        return view('backEnd.webmanagement.social.add',compact('link'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmSocial  $wmSocial
     * @return \Illuminate\Http\Response
     */
    public function show(WmSocial $wmSocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmSocial  $wmSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(WmSocial $wmSocial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmSocial  $wmSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->except('_token','_method');
        $wmSchool=WmSocial::where('school_id', Auth::getSchool())->first();
        if(!$wmSchool){
            WmSocial::create($data);
        }else{
            $wmSchool->update($data);
        }
        return $this->returnWithSuccess('Data updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmSocial  $wmSocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(WmSocial $wmSocial)
    {
        //
    }
}
