<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeeSetup;
use App\FeeCategory;
use App\FeeSubCategory;
use App\GroupClass;
use Auth;

class FeeSubCategoryController extends Controller
{
    public function fee_sub_category_add(){
        $classes = $this->getClasses();
        $groups = $this->groupClasses();
        $fee_categories = FeeCategory::orderBy('id', 'asc')->get();
        $fee_sub_categories = FeeSubCategory::orderBy('id', 'desc')->where('status', 1)->get();
        return view('backEnd.accounts.fee_sub_category.add', compact('fee_categories', 'fee_sub_categories', 'classes', 'groups'));
    }

    public function fee_sub_category_store(Request $request){
      $this->validate($request, [
        "name" => "required",
        "master_class_id" => "required",
        "group_class_id" => "required",
        "fee_category_id" => "required",
      ]);
      $fee_sub_category = new FeeSubCategory;
      $data = $request->all();
      $data['school_id'] = Auth::getSchool();
      $fee_sub_category->create($data);
      return redirect()->back()->with('success_msg', 'সাব-ক্যাটাগরি সফলভাবে যোগ করা হয়েছে ।');
    }

    public function fee_sub_category_edit($id){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $fee_categories = FeeCategory::orderBy('id', 'asc')->get();
      $fee_sub_category = FeeSubCategory::find($id);
      // return $fee_sub_category;
      return view('backEnd.accounts.fee_sub_category.edit', compact('fee_sub_category', 'fee_categories', 'classes', 'groups'));
    }

    public function fee_sub_category_update(Request $request){
      $this->validate($request, [
        "name" => "required",
        "master_class_id" => "required",
        "group_class_id" => "required",
        "fee_category_id" => "required",
      ]);
      $fee_sub_category = FeeSubCategory::find($request->id);
      $data = $request->all();
      $fee_sub_category->update($data);
      return redirect()->route('fee_sub_category_add')->with('success_msg', 'সাব-ক্যাটাগরি সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function fee_sub_category_delete(Request $request){
      $fee_sub_category = FeeSubCategory::find($request->id);
      $fee_sub_category->delete();
      return redirect()->route('fee_sub_category_add')->with('success_msg', 'সাব-ক্যাটাগরি সফলভাবে মুছে ফেলা হয়েছে ।');
    }
}
