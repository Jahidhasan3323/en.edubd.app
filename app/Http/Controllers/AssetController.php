<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use Auth;

class AssetController extends Controller
{
    public function asset_add(){
      $assets = Asset::where('status', 1)->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.asset.add', compact('assets'));
    }

    public function asset_store(Request $request){
      $this->validate($request, [
        "asset_name" => "required|string|max:255",
        "qty" => "required",
        "unit_price" => "required",
        "start_date" => "required",
      ]);
      if (!empty($request->asset_valuation_increase && $request->asset_valuation_decrease)) {
        return redirect()->back()->with('error_msg', 'সম্পত্তির মূল্য বৃদ্ধি বা হ্রাস এর যেকন একটি হবে ।');
      }
      $last_deposit = Asset::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->first();
      if ($last_deposit) {
        $serial = $last_deposit->serial+1;
      }else {
        $serial = date('Y')."10000";
      }
      $total_price = ($request->qty*$request->unit_price);
      $asset = new Asset;
      $data = $request->except(['start_date', 'end_date']);
      $data['school_id'] = Auth::getSchool();
      $data['serial'] = $serial;
      $data['total_price'] = $total_price;
      $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
      $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
      $asset->create($data);
      return redirect()->back()->with('success_msg', 'সম্পত্তি সফলভাবে সংরক্ষণ করা হয়েছে ।');
    }

    public function asset_edit($id){
      $asset = Asset::find($id);
      return view('backEnd.accounts.asset.edit', compact('asset'));
    }

    public function asset_update(Request $request){
      $this->validate($request, [
        "asset_name" => "required|string|max:255",
        "qty" => "required",
        "unit_price" => "required",
        "start_date" => "required",
      ]);
      if (!empty($request->asset_valuation_increase && $request->asset_valuation_decrease)) {
        return redirect()->back()->with('error_msg', 'সম্পত্তির মূল্য বৃদ্ধি বা হ্রাস এর যেকন একটি হবে ।');
      }
      $total_price = ($request->qty*$request->unit_price);
      $asset = Asset::find($request->id);
      $data = $request->except(['start_date', 'end_date']);
      $data['total_price'] = $total_price;
      $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
      $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
      $asset->update($data);
      return redirect()->route('asset_add')->with('success_msg', 'সম্পত্তি সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function asset_delete(Request $request){
      $asset = Asset::find($request->id);
      $asset->delete();
      return redirect()->route('asset_add')->with('success_msg', 'সম্পত্তি সফলভাবে মুছে ফেলা হয়েছে ।');
    }


}
