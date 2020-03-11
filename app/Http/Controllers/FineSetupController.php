<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FineSetup;
use Auth;

class FineSetupController extends Controller
{
    public function fine_setup_add(){
        $classes = $this->getClasses();
        $groups = $this->groupClasses();
        $fine_setups = FineSetup::orderBy('id', 'asc')->get();
        return view('backEnd.accounts.fine_setup.add', compact('fine_setups', 'classes', 'groups'));
    }

    public function fine_setup_store(Request $request){
      $this->validate($request, [
        "amount" => "required",
        "master_class_id" => "required",
        "group_class_id" => "required",
        "shift" => "required",
      ]);
      $fine_setup = new FineSetup;
      $data = $request->all();
      $data['school_id'] = Auth::getSchool();
      $fine_setup->create($data);
      return redirect()->back()->with('success_msg', 'জরিমানা সফলভাবে নির্ধারণ করা হয়েছে ।');
    }

    public function fine_setup_edit($id){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $fine_setup = FineSetup::find($id);
      // return $fine_setup;
      return view('backEnd.accounts.fine_setup.edit', compact('fine_setup', 'classes', 'groups'));
    }

    public function fine_setup_update(Request $request){
      $this->validate($request, [
        "amount" => "required",
        "master_class_id" => "required",
        "group_class_id" => "required",
        "shift" => "required",
      ]);
      $fine_setup = FineSetup::find($request->id);
      $data = $request->all();
      $fine_setup->update($data);
      return redirect()->route('fine_setup_add')->with('success_msg', 'জরিমানা সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function fine_setup_delete(Request $request){
      $fine_setup = FineSetup::find($request->id);
      $fine_setup->delete();
      return redirect()->route('fine_setup_add')->with('success_msg', 'জরিমানা সফলভাবে মুছে ফেলা হয়েছে ।');
    }


}
