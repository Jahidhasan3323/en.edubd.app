<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MessageLength;
use App\School;

class MessageLengthController extends Controller
{
	public function add(){
		$msg_len = MessageLength::select('school_id')->get();
		$schools = School::whereNotIn('id',$msg_len)->get();
		return view('backEnd.message_length.add',compact('schools'));
	}

    public function store(Request $request){
		$data = $request->all();
		MessageLength::create($data);
		return redirect()->route('messageLength.list')->with('sccmgs','বার্তা সেটিং সফলভাবে যোগ করা হয়েছে ।');
	}

    public function list(Request $request){
		$message_lengths = MessageLength::all();
		return view('backEnd.message_length.list',compact('message_lengths'));
	}

    public function edit($id){
		$msg_len = MessageLength::select('school_id')->get();
		$schools = School::whereNotIn('id',$msg_len)->get();
		$message_length = MessageLength::find($id);
		return view('backEnd.message_length.edit',compact('message_length','schools'));
	}

    public function update(Request $request, $id){
       $data = $request->all();
       MessageLength::find($id)->update($data);
       return redirect()->route('messageLength.list')->with('sccmgs','বার্তা সফলভাবে আপডেট করা হয়েছে ।');
   }

    public function delete($id){
       MessageLength::find($id)->delete();
       return redirect()->route('messageLength.list')->with('sccmgs','বার্তা সফলভাবে মুছে ফেলা হয়েছে ।');
   }

}
