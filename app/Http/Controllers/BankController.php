<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use Auth;

class BankController extends Controller
{
    public function bank_add(){
      $banks = Bank::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.bank.add', compact('banks'));
    }

    public function bank_store(Request $request){
      $this->validate($request, [
        "name" => "required|string|max:191",
      ]);
      $bank = new Bank;
      $data = $request->all();
      $data['school_id'] = Auth::getSchool();
      $bank->create($data);
      return redirect()->back()->with('success_msg', 'ব্যাংক সফলভাবে যোগ করা হয়েছে ।');
    }

    public function bank_edit($id){
      $bank = Bank::find($id);
      return view('backEnd.accounts.bank.edit', compact('bank'));
    }

    public function bank_update(Request $request){
      $this->validate($request, [
        "name" => "required|string|max:191",
      ]);
      $bank = Bank::find($request->id);
      $data = $request->all();
      $bank->update($data);
      return redirect()->route('bank_add')->with('success_msg', 'ব্যাংক সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function bank_delete(Request $request){
      $bank = Bank::find($request->id);
      $bank->delete();
      return redirect()->route('bank_add')->with('success_msg', 'ব্যাংক সফলভাবে মুছে ফেলা হয়েছে ।');
    }
}
