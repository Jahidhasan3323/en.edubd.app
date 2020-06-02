<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BirthdayText;
use App\School;

class BirthdayTextController extends Controller
{
    public function add(){
		$schools = School::all();
		return view('backEnd.birthday_text.add',compact('schools'));
	}

    public function store(Request $request){
		$data = $request->all();
		BirthdayText::create($data);
		return redirect()->route('birthdayText.list')->with('sccmgs','Birthday Message Added Successfully.');
	}

    public function list(Request $request){
		$birthdat_texts = BirthdayText::all();
		return view('backEnd.birthday_text.list',compact('birthdat_texts'));
	}

    public function edit($id){
        $schools = School::all();
		$birthdat_text = BirthdayText::find($id);
		return view('backEnd.birthday_text.edit',compact('birthdat_text','schools'));
	}

    public function update(Request $request, $id){
       $data = $request->all();
       BirthdayText::find($id)->update($data);
       return redirect()->route('birthdayText.list')->with('sccmgs','Birthday Message Updated Successfully.');
   }

    public function delete($id){
       BirthdayText::find($id)->delete();
       return redirect()->route('birthdayText.list')->with('sccmgs','Birthday Message Deleted Successfully.');
   }



}
