<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ElectiveSetting;
use Illuminate\Support\Facades\Auth;
use Session;

class ElectiveSettingController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $classes= $this->getClasses();
        $groups= $this->groupClasses();
        $elective_settings= ElectiveSetting::with('master_class','group_class')->where('school_id',Auth::getSchool())->get();
        return view('backEnd.electiveSetting.elective_setting',compact('classes','groups','elective_settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $this->validation_form($request);
        ElectiveSetting::create($request->all());
        return $this->returnWithSuccess('Setting Success..!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes= $this->getClasses();
        $groups= $this->groupClasses();
        $elective_setting=ElectiveSetting::where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
        return view('backEnd.electiveSetting.edit',compact('classes','groups','elective_setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validation_form($request);
        ElectiveSetting::where(['id'=>$id,'school_id'=>Auth::getSchool()])->update($request->except('_token'));
        Session::flash('sccmgs', 'Update Success..!');
        return redirect('elective/setting');
    }

    protected function validation_form($request){
        $this->validate($request,[
            'master_class_id'=>'required',
            'group_class_id'=>'required',
            'compulsary_elective'=>'required',
            'optional_elective'=>'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ElectiveSetting::where(['id'=>$id,'school_id'=>Auth::getSchool()])->delete();
        return $this->returnWithError('Delete Success..!');
    }
}
