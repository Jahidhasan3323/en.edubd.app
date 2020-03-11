<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Care;
use Auth;
use Storage;

class CareController extends Controller
{
    public function add(){
		return view('backEnd.care.problem.add');
	}

    public function store(Request $request){
		$this->validate($request, [
			"subject" => "string|max:255|nullable",
			"description" => "required",
		]);
        $last_problem = Care::orderBy('id','desc')->first();
        if ($last_problem) {
            $token = $last_problem->token+1;
        }else {
            $token = 1001;
        }
		$data = $request->except('image');
		$data['token'] = $token;
		if ($request->hasFile('image')) {
			$data['image'] = $this->imagesProcessing1($request->image, 'problem',600,400);
		}
		Care::create($data);
        if ($request->type==1) {
            return redirect()->route('advice.list')->with('sccmgs','পরামর্শ সফলভাবে জমা করা হয়েছে ।');
        }else {
           return redirect()->route('problem.list')->with('sccmgs','সমস্যা সফলভাবে জমা করা হয়েছে ।');
        }

	}
	

    public function list(Request $request){
		$pending_problems = Care::orderBy('id','desc')->where('school_id', Auth::getSchool())->where('type',2)->where('status', 0)->where('from',1)->get();
		$success_problems = Care::orderBy('id','desc')->where('school_id', Auth::getSchool())->where('type',2)->where('status', 1)->where('from',1)->get();
		return view('backEnd.care.problem.list',compact('pending_problems','success_problems'));
	}

    public function edit(Request $request){
		$problem = Care::find($request->id);
		return view('backEnd.care.problem.edit',compact('problem'));
	}

    public function update(Request $request){
        $this->validate($request, [
			"subject" => "string|max:255|nullable",
			"description" => "required",
		]);
        $last_problem = Care::orderBy('id','desc')->first();
		$data = $request->except('image');
		if ($request->hasFile('image')) {
            if ($request->image) {
                Storage::delete($request->image);
            }
			$data['image'] = $this->imagesProcessing1($request->image, 'problem',600,400);
		}
		Care::find($request->id)->update($data);
        if ($request->type==1) {
            return redirect()->route('advice.list')->with('sccmgs','পরামর্শ সফলভাবে আপডেট করা হয়েছে ।');
        }else {
           return redirect()->route('problem.list')->with('sccmgs','সমস্যা সফলভাবে আপডেট করা হয়েছে ।');
        }

	}

    public function delete(Request $request){
		$problem = Care::find($request->id);
		$problem->delete();
        if ($problem->type==1) {
            return redirect()->back()->with('sccmgs','পরামর্শ সফলভাবে মুছে ফেলা হয়েছে  ।');
        }else {
            return redirect()->back()->with('sccmgs','সমস্যা সফলভাবে মুছে ফেলা হয়েছে ।');
        }
	}
	public function website_problem(Request $request){
		$pending_problems = Care::orderBy('id','desc')->where(['type'=>2,'school_id'=>Auth::getSchool(),'status'=>0,'from'=>2])->get();
		$success_problems = Care::orderBy('id','desc')->where(['type'=>2,'school_id'=>Auth::getSchool(),'status'=>1,'from'=>2])->get();
		return view('backEnd.care.problem.web_list',compact('pending_problems','success_problems'));
	}


    /* ************************************
    Advice Controller
    ********************************** */

    public function advice_add(){
		return view('backEnd.care.advice.add');
	}

    public function advice_list(Request $request){
		$unseen_advices = Care::orderBy('id','desc')->where('school_id', Auth::getSchool())->where('type',1)->where('status', 0)->get();
		$seen_advices = Care::orderBy('id','desc')->where('school_id', Auth::getSchool())->where('type',1)->where('status', 1)->get();
		return view('backEnd.care.advice.list',compact('unseen_advices','seen_advices'));
	}

    public function advice_edit(Request $request){
		$advice = Care::find($request->id);
		return view('backEnd.care.advice.edit',compact('advice'));
	}

    /* ************************************
    Root User Controller
    ********************************** */
    public function root_advice(Request $request){
		$unseen_advices = Care::orderBy('id','desc')->where('type',1)->where('status',0)->get();
		$seen_advices = Care::orderBy('id','desc')->where('type',1)->where('status',1)->get();
		return view('backEnd.care.advice.root_advice',compact('unseen_advices','seen_advices'));
	}

    public function root_problem(Request $request){
		$pending_problems = Care::orderBy('id','desc')->where('type',2)->where('status',0)->where('from',1)->get();
		$success_problems = Care::orderBy('id','desc')->where('type',2)->where('status',1)->where('from',1)->get();
		return view('backEnd.care.problem.root_problem',compact('pending_problems','success_problems'));
	}


    public function move01(Request $request){
		$data = Care::find($request->id);
		$data->status = 1;
        $data->save();
        if ($data->type==1) {
            return redirect()->back()->with('sccmgs','পরামর্শ সফলভাবে পরিবর্তন করা হয়েছে  ।');
        }else {
            return redirect()->back()->with('sccmgs','সমস্যা সফলভাবে পরিবর্তন করা হয়েছে ।');
        }
	}


	public function website_advice(Request $request){
		$unseen_advices = Care::orderBy('id','desc')->where(['type'=>1,'school_id'=>Auth::getSchool(),'status'=>0,'from'=>2])->get();
		$seen_advices = Care::orderBy('id','desc')->where(['type'=>1,'school_id'=>Auth::getSchool(),'status'=>1,'from'=>2])->get();
		return view('backEnd.care.advice.web_list',compact('unseen_advices','seen_advices'));
	}



}
