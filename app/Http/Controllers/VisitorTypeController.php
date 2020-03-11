<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VisitorType;
use Auth;

class VisitorTypeController extends Controller
{
	public function add(){
		$visitor_types = VisitorType::where('school_id', Auth::getSchool())->get();
		return view('backEnd.visitor.visitor_type.add',compact('visitor_types'));
	}

    public function store(Request $request){
		$this->validate($request, [
			"name" => "required|string|max:255|nullable",
		]);
		$data = $request->all();
		VisitorType::create($data);
        return redirect()->route('visitorType.add')->with('sccmgs','ভিজিটরের ধরণ সফলভাবে জমা করা হয়েছে ।');

	}

    public function edit(Request $request){
		$visitor_type = VisitorType::find($request->id);
		return view('backEnd.visitor.visitor_type.edit',compact('visitor_type'));
	}

    public function update(Request $request){
		$this->validate($request, [
			"name" => "required|string|max:255|nullable",
		]);
		$data = $request->all();
		VisitorType::find($request->id)->update($data);
        return redirect()->route('visitorType.add')->with('sccmgs','ভিজিটরের ধরণ সফলভাবে আপডেট করা হয়েছে ।');
	}

    public function delete(Request $request){
		$visitor_type = VisitorType::find($request->id);
		$visitor_type->delete();
        return redirect()->route('visitorType.add')->with('sccmgs','ভিজিটরের ধরণ সফলভাবে মুছে ফেলা হয়েছে ।');
	}





}
