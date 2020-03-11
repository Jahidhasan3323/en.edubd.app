<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankDeposit;
use App\Bank;
use App\BankAccountType;
use Auth;

class BankDepositController extends Controller
{
    public function bank_deposit_add(){
      $banks = Bank::where('status', 1)->where('school_id', Auth::getSchool())->get();
      $account_types = BankAccountType::where('status', 1)->where('school_id', Auth::getSchool())->get();
      $bank_deposits = BankDeposit::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.bank_deposit.add', compact('bank_deposits', 'banks', 'account_types'));
    }

    public function bank_deposit_store(Request $request){
      $this->validate($request, [
        "bank_id" => "required",
        "account_type_id" => "required",
        "account_number" => "required",
        "deposit_number" => "required",
        "amount" => "required",
        "deposit_by" => "required",
        "deposit_date" => "required",
      ]);
      $last_deposit = BankDeposit::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->first();
      if ($last_deposit) {
        $serial = $last_deposit->serial+1;
      }else {
        $serial = date('Y')."10000";
      }
      $bank_deposit = new BankDeposit;
      $data = $request->except(['deposit_date']);
      $data['school_id'] = Auth::getSchool();
      $data['serial'] = $serial;
      $data['deposit_date'] = date('Y-m-d', strtotime($request->deposit_date));
      // return $data;
      $bank_deposit->create($data);
      return redirect()->back()->with('success_msg', 'ব্যাংক ডিপোজিট সফলভাবে সংরক্ষণ করা হয়েছে ।');
    }

    public function bank_deposit_edit($id){
      $banks = Bank::where('status', 1)->where('school_id', Auth::getSchool())->get();
      $account_types = BankAccountType::where('status', 1)->where('school_id', Auth::getSchool())->get();
      $bank_deposits = BankDeposit::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      $bank_deposit = BankDeposit::find($id);
      return view('backEnd.accounts.bank_deposit.edit', compact('bank_deposit', 'bank_deposits', 'banks', 'account_types'));
    }

    public function bank_deposit_update(Request $request){
      $this->validate($request, [
        "bank_id" => "required",
        "account_type_id" => "required",
        "account_number" => "required",
        "deposit_number" => "required",
        "amount" => "required",
        "deposit_by" => "required",
        "deposit_date" => "required",
      ]);
      $bank_deposit = BankDeposit::find($request->id);
      $data = $request->except(['deposit_date']);
      $data['deposit_date'] = date('Y-m-d', strtotime($request->deposit_date));
      $bank_deposit->update($data);
      return redirect()->route('bank_deposit_add')->with('success_msg', 'ব্যাংক ডিপোজিট সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function bank_deposit_delete(Request $request){
      $bank_deposit = BankDeposit::find($request->id);
      $bank_deposit->delete();
      return redirect()->route('bank_deposit_add')->with('success_msg', 'ব্যাংক ডিপোজিট সফলভাবে মুছে ফেলা হয়েছে ।');
    }

    public function bank_provident_fund_list(){
      $bank_deposits = BankDeposit::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->where('account_type_id', 0)->get();
      return view('backEnd.accounts.provident_fund.bank_deposit', compact('bank_deposits'));
    }


}
