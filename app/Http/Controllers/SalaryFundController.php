<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalaryFund;
use Auth;

class SalaryFundController extends Controller
{
    public function salary_fund_add(){
      $salary_funds = SalaryFund::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.salary_fund.add', compact('salary_funds'));
    }

    public function salary_fund_store(Request $request){
      $this->validate($request, [
        "name" => "required",
        "amount" => "required",
        "status" => "required",
      ]);
      $salary_fund = new SalaryFund;
      $data = $request->all();
      $data['school_id'] = Auth::getSchool();
      $salary_fund->create($data);
      return redirect()->route('salary_fund_add')->with('success_msg', 'সেলারি ফান্ড সফলভাবে যোগ করা হয়েছে ।');
    }

    public function salary_fund_edit($id){
      $salary_fund = SalaryFund::find($id);
      return view('backEnd.accounts.salary_fund.edit', compact('salary_fund'));
    }

    public function salary_fund_update(Request $request){
      $this->validate($request, [
        "name" => "required",
        "amount" => "required",
        "status" => "required",
      ]);
      $salary_fund = SalaryFund::find($request->id);
      $data = $request->all();
      $salary_fund->update($data);
      return redirect()->route('salary_fund_add')->with('success_msg', 'সেলারি ফান্ড সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function salary_fund_delete(Request $request){
      $salary_fund = SalaryFund::find($request->id);
      $salary_fund->delete();
      return redirect()->route('salary_fund_add')->with('success_msg', 'সেলারি ফান্ড সফলভাবে মুছে ফেলা হয়েছে ।');
    }


}
