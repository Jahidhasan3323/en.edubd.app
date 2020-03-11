<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountSetting;
use Auth;

class AccountSettingController extends Controller
{
    public function account_setting_add(){
      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      return view('backEnd.accounts.setting', compact('account_setting'));
    }

    public function account_setting_store(Request $request){
      $this->validate($request, [
        "voucher_title" => "required|string|max:191",
        "provident_fund_rate" => "required|numeric",
      ]);
      $account_setting = new AccountSetting;
      $data = $request->all();
      $data['school_id'] = Auth::getSchool();
      $account_setting->create($data);
      return redirect()->route('account_setting_add')->with('success_msg', 'একাউন্ট সেটিং সফলভাবে যোগ করা হয়েছে ।');
    }

    public function account_setting_update(Request $request){
      $this->validate($request, [
        "voucher_title" => "required|string|max:191",
        "provident_fund_rate" => "required|numeric",
      ]);
      $account_setting = AccountSetting::find($request->id);
      $data = $request->all();
      $account_setting->update($data);
      return redirect()->route('account_setting_add')->with('success_msg', 'একাউন্ট সেটিং সফলভাবে আপডেট করা হয়েছে ।');
    }


}
