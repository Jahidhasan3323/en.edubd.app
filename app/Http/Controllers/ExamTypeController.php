<?php

namespace App\Http\Controllers;

use App\ExamType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClassController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExamTypeController extends Controller
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
        if (!Auth::is('root')&&!Auth::is('admin') && !Auth::is('teacher')){
            return redirect('/home');
        }
        $exams = ExamType::get();
        return view('backEnd.exam.info', compact('exams'));
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
        return view('backEnd.exam.add');
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

        $this->validate($request, [
            'name' => 'required|unique:exam_types'
        ]);
        if (ExamType::create($request->all())){
            Session::flash('sccmgs', 'পরীক্ষার ধরণ সফলভাবে যোগ করা হয়েছে !');
            return redirect()->back();
        }

        Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExamType  $examType
     * @return \Illuminate\Http\Response
     */
    public function show(ExamType $examType)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamType  $examType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamType $examType)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        return view('backEnd.exam.edit', compact('examType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamType  $examType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamType $examType)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        $this->validate($request, [
            'name' => 'required'
        ]);
        $name = $request->only('name');
        if ($examType->update($name)){
            Session::flash('sccmgs', 'পরীক্ষার ধরণ সফলভাবে আপডেট করা হয়েছে !');
            return redirect()->back();
        }

        Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamType  $examType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamType $examType)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        if ($examType->delete()){
            Session::flash('sccmgs', 'পরীক্ষার ধরণ সফলভাবে মুছে ফেলা হয়ছে !');
            return redirect()->back();
        }

        Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !');
        return redirect()->back();
    }
}
