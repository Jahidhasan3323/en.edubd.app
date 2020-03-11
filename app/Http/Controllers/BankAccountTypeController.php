<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankAccountType;
use Auth;

class BankAccountTypeController extends Controller
{
    public function bank_aacount_type_add(){
      $bank_aacount_types = BankAccountType::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.bank_aacount_type.add', compact('bank_aacount_types'));
    }

    public function bank_aacount_type_store(Request $request){
      $this->validate($request, [
        "name" => "required|string|max:191",
      ]);
      $bank_aacount_type = new BankAccountType;
      $data = $request->all();
      $data['school_id'] = Auth::getSchool();
      $bank_aacount_type->create($data);
      return redirect()->back()->with('success_msg', 'ব্যাংক একাউন্টের ধরণ সফলভাবে যোগ করা হয়েছে ।');
    }

    public function bank_aacount_type_edit($id){
      $bank_aacount_type = BankAccountType::find($id);
      return view('backEnd.accounts.bank_aacount_type.edit', compact('bank_aacount_type'));
    }

    public function bank_aacount_type_update(Request $request){
      $this->validate($request, [
        "name" => "required|string|max:191",
      ]);
      $bank_aacount_type = BankAccountType::find($request->id);
      $data = $request->all();
      $bank_aacount_type->update($data);
      return redirect()->route('bank_aacount_type_add')->with('success_msg', 'ব্যাংক একাউন্টের ধরণ সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function bank_aacount_type_delete(Request $request){
      $bank_aacount_type = BankAccountType::find($request->id);
      $bank_aacount_type->delete();
      return redirect()->route('bank_aacount_type_add')->with('success_msg', 'ব্যাংক একাউন্টের ধরণ সফলভাবে মুছে ফেলা হয়েছে ।');
    }


}
