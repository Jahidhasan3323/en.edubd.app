<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VisitorType;
use App\Visitor;
use Auth;
use Storage;

class VisitorController extends Controller
{
	public function add(){
		$visitor_types = VisitorType::where('school_id', Auth::getSchool())->get();
		return view('backEnd.visitor.visitor.add',compact('visitor_types'));
	}

    public function store(Request $request){
		$this->validate($request, [
			"name" => "required|string|max:255",
			"visitor_type_id" => "required",
			"in_time" => "required",
			"designation" => "required",
			"purpose" => "required",
		]);

		$data = $request->except(['image']);
		$data['date'] = date('Y-m-d');
		if ($request->hasFile('image')) {
			$data['image'] = $this->imagesProcessing1($request->image, 'visitor',600,400);
		}
		Visitor::create($data);
        return redirect()->route('visitor.list')->with('sccmgs','ভিজিটর সফলভাবে জমা করা হয়েছে ।');

	}

    public function list(Request $request){
		$visitors = Visitor::orderBy('id','desc')->where('school_id', Auth::getSchool())->whereDate('date', date('Y-m-d'))->get();
		return view('backEnd.visitor.visitor.list',compact('visitors'));
	}

    public function edit(Request $request){
		$visitor = Visitor::find($request->id);
		$visitor_types = VisitorType::where('school_id', Auth::getSchool())->get();
		return view('backEnd.visitor.visitor.edit',compact('visitor','visitor_types'));
	}

    public function update(Request $request){
		$this->validate($request, [
 		   "name" => "required|string|max:255",
 		   "visitor_type_id" => "required",
 		   "in_time" => "required",
 		   "designation" => "required",
 		   "purpose" => "required",
 	   ]);
	   	// return $request->out_time;
		$data = $request->except(['image']);
		$data['date'] = date('Y-m-d');
		if ($request->hasFile('image')) {
		   $data['image'] = $this->imagesProcessing1($request->image, 'visitor',600,400);
		}
		Visitor::find($request->id)->update($data);
		return redirect()->route('visitor.list')->with('sccmgs','ভিজিটর সফলভাবে আপডেট করা হয়েছে ।');

	}

    public function delete(Request $request){
		$visitor = Visitor::find($request->id);
		if ($visitor->image) {
			Storage::delete($visitor->image);
		}
		$visitor->forceDelete();
        return redirect()->route('visitor.list')->with('sccmgs','ভিজিটর সফলভাবে মুছে ফেলা হয়েছে ।');
	}



}
