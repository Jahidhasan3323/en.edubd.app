<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BanksWithdraw;
use App\Bank;
use App\BankAccountType;
use Auth;

class BankWithdrawController extends Controller
{
    public function bank_withdraw_add(){
      $banks = Bank::where('status', 1)->where('school_id', Auth::getSchool())->get();
      $account_types = BankAccountType::where('status', 1)->where('school_id', Auth::getSchool())->get();
      $bank_withdraws = BanksWithdraw::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.bank_withdraw.add', compact('bank_withdraws', 'banks', 'account_types'));
    }

    public function bank_withdraw_store(Request $request){
      $this->validate($request, [
        "bank_id" => "required",
        "account_type_id" => "required",
        "account_number" => "required",
        "check_number" => "required",
        "amount" => "required",
        "withdraw_by" => "required",
        "withdra_date" => "required",
      ]);
      $last_withdraw = BanksWithdraw::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->first();
      if ($last_withdraw) {
        $serial = $last_withdraw->serial+1;
      }else {
        $serial = date('Y')."10000";
      }
      $bank_withdraw = new BanksWithdraw;
      $data = $request->except(['withdra_date']);
      $data['school_id'] = Auth::getSchool();
      $data['serial'] = $serial;
      $data['withdra_date'] = date('Y-m-d', strtotime($request->withdra_date));
      $bank_withdraw->create($data);
      return redirect()->back()->with('success_msg', 'ব্যাংক থেকে টাকা উত্তোলন সফলভাবে হয়েছে ।');
    }

    public function bank_withdraw_edit($id){
      $banks = Bank::where('status', 1)->where('school_id', Auth::getSchool())->get();
      $account_types = BankAccountType::where('status', 1)->where('school_id', Auth::getSchool())->get();
      $bank_withdraws = BanksWithdraw::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      $bank_withdraw = BanksWithdraw::find($id);
      return view('backEnd.accounts.bank_withdraw.edit', compact('bank_withdraw', 'bank_withdraws', 'banks', 'account_types'));
    }

    public function bank_withdraw_update(Request $request){
      $this->validate($request, [
        "bank_id" => "required",
        "account_type_id" => "required",
        "account_number" => "required",
        "check_number" => "required",
        "amount" => "required",
        "withdraw_by" => "required",
        "withdra_date" => "required",
      ]);
      $bank_withdraw = BanksWithdraw::find($request->id);
      $data = $request->except(['deposit_date']);
      $data['deposit_date'] = date('Y-m-d', strtotime($request->deposit_date));
      $bank_withdraw->update($data);
      return redirect()->route('bank_withdraw_add')->with('success_msg', 'ব্যাংক থেকে উত্তোলন সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function bank_withdraw_delete(Request $request){
      $bank_withdraw = BanksWithdraw::find($request->id);
      $bank_withdraw->delete();
      return redirect()->route('bank_withdraw_add')->with('success_msg', 'ব্যাংক থেকে টাকা উত্তোলন সফলভাবে মুছে ফেলা হয়েছে ।');
    }


}
