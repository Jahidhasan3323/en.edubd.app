<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeeCategory;

class FeeCategoryController extends Controller
{
    public function fee_category_add(){
      $fee_categories = FeeCategory::orderBy('id', 'desc')->get();
      return view('backEnd.accounts.fee_category.add', compact('fee_categories'));
    }

    public function fee_category_store(Request $request){
      $this->validate($request, [
        "name" => "required|string|max:191",
      ]);
      $fee_category = new FeeCategory;
      $data = $request->all();
      $fee_category->create($data);
      return redirect()->back()->with('success_msg', 'ফি ক্যাটাগরি সফলভাবে যোগ করা হয়েছে ।');
    }

    public function fee_category_edit($id){
      $fee_category = FeeCategory::find($id);
      return view('backEnd.accounts.fee_category.edit', compact('fee_category'));
    }

    public function fee_category_update(Request $request){
      $this->validate($request, [
        "name" => "required|string|max:191",
      ]);
      $fee_category = FeeCategory::find($request->id);
      $data = $request->all();
      $fee_category->update($data);
      return redirect()->route('fee_category_add')->with('success_msg', 'ফি ক্যাটাগরি সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function fee_category_delete(Request $request){
      $fee_category = FeeCategory::find($request->id);
      $fee_category->delete();
      return redirect()->route('fee_category_add')->with('success_msg', 'ফি ক্যাটাগরি সফলভাবে মুছে ফেলা হয়েছে ।');
    }


}
