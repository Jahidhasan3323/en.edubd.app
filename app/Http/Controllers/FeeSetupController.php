<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeeSetup;
use App\FeeCategory;
use App\GroupClass;
use Auth;

class FeeSetupController extends Controller
{
    public function fee_setup_add(){
        $classes = $this->getClasses();
        $groups = $this->groupClasses();
        $fee_categories = FeeCategory::orderBy('id', 'asc')->get();
        $fee_amounts = FeeSetup::orderBy('id', 'asc')->get();
        return view('backEnd.accounts.fee_setup.add', compact('fee_categories', 'fee_amounts', 'classes', 'groups'));
    }

    public function fee_setup_store(Request $request){
      $this->validate($request, [
        "amount" => "required",
        "master_class_id" => "required",
        "group_class_id" => "required",
        "shift" => "required",
        "fee_category_id" => "required",
      ]);
      $duplicate = FeeSetup::orderBy('id', 'asc')
                  ->where('master_class_id', $request->master_class_id)
                  ->where('group_class_id', $request->group_class_id)
                  ->where('shift', $request->shift)
                  ->where('fee_category_id', $request->fee_category_id)
                  ->first();
      if ($duplicate) {
        return redirect()->back()->with('success_msg', 'পূর্বেই সফলভাবে নির্ধারণ করা হয়েছে ।');
      }
      $fee_setup = new FeeSetup;
      $data = $request->all();
      $data['school_id'] = Auth::getSchool();
      $fee_setup->create($data);
      return redirect()->back()->with('success_msg', 'ফি সফলভাবে নির্ধারণ করা হয়েছে ।');
    }

    public function fee_setup_edit($id){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $fee_categories = FeeCategory::orderBy('id', 'asc')->get();
      $fee_setup = FeeSetup::find($id);
      // return $fee_setup;
      return view('backEnd.accounts.fee_setup.edit', compact('fee_setup', 'fee_categories', 'classes', 'groups'));
    }

    public function fee_setup_update(Request $request){
      $this->validate($request, [
        "amount" => "required",
        "master_class_id" => "required",
        "group_class_id" => "required",
        "shift" => "required",
        "fee_category_id" => "required",
      ]);
      $fee_setup = FeeSetup::find($request->id);
      $data = $request->all();
      $fee_setup->update($data);
      return redirect()->route('fee_setup_add')->with('success_msg', 'ফি সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function fee_setup_delete(Request $request){
      $fee_setup = FeeSetup::find($request->id);
      $fee_setup->delete();
      return redirect()->route('fee_setup_add')->with('success_msg', 'ফি সফলভাবে মুছে ফেলা হয়েছে ।');
    }




}
