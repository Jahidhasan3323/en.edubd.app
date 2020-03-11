<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProvidentFund;
use App\Staff;
use App\AccountSetting;
use App\SalarySetup;
use Session;
use Auth;

class ProvidentFundController extends Controller
{
    public function provident_fund_add(){
      return view('backEnd.accounts.provident_fund.add');
    }

    public function provident_fund_store(Request $request){
      $this->validate($request, [
        "month" => "required",
        "year" => "required",
      ]);
      $month = $request->month;
      $year = $request->year;
      // return $year;
      $employees = Staff::where('school_id', Auth::getSchool())->get();
      $providentFundRate = AccountSetting::where('school_id', Auth::getSchool())->first();
      foreach ($employees as $key => $employee) {
        $duplicate = ProvidentFund::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->where('month', $month)->where('year', $year)->where('employee_id', $employee->id)->first();
        $basicSalary = SalarySetup::where('school_id', Auth::getSchool())->where('employee_id', $employee->id)->first();
        if (empty($duplicate) && !empty($basicSalary)) {
          $provident_fund = new ProvidentFund;
          $data = $request->all();
          $data['school_id'] = Auth::getSchool();
          $data['employee_id'] = $employee->id;
          $data['amount'] = ($basicSalary->amount*$providentFundRate->provident_fund_rate)/100;
          $provident_fund->create($data);
        }
      }
      $provident_funds = ProvidentFund::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->where('month', $month)->where('year', $year)->get();
      return view('backEnd.accounts.provident_fund.add', compact('provident_funds', 'month', 'year'));
    }

    public function provident_fund_delete(Request $request){
      $provident_fund = ProvidentFund::find($request->id);
      $month = $provident_fund->month;
      $year = $provident_fund->year;
      $provident_fund->delete();
      $provident_funds = ProvidentFund::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->where('month', $month)->where('year', $year)->get();
      return view('backEnd.accounts.provident_fund.add', compact('provident_funds', 'month', 'year'));
    }


}
