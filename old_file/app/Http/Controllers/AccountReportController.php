<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeeCollection;
use App\Income;
use App\Expense;
use App\Fund;
use App\Student;
use App\BankDeposit;
use App\BanksWithdraw;
use App\FineCollection;
use App\Asset;
use Auth;

class AccountReportController extends Controller
{
    public function account_dashboard(){
      $fee_collection = FeeCollection::where('school_id', Auth::getSchool())->sum('paid');
      $total_due = FeeCollection::where('school_id', Auth::getSchool())->sum('due');
      $total_due_paid = FeeCollection::where('school_id', Auth::getSchool())->sum('due_paid');
      $current_due = $total_due-$total_due_paid;
      $total_fee_collection = $fee_collection+$total_due_paid;
      $total_income = Income::where('school_id', Auth::getSchool())->sum('amount');
      $total_expense = Expense::where('school_id', Auth::getSchool())->sum('amount');
      $total_deposit = BankDeposit::where('school_id', Auth::getSchool())->sum('amount');
      $total_withdraw = BanksWithdraw::where('school_id', Auth::getSchool())->sum('amount');
      $total_asset = Asset::where('school_id', Auth::getSchool())->sum('total_price');
      $total_fine = FineCollection::where('school_id', Auth::getSchool())->sum('paid');
      return view('backEnd.accounts.dashboard', compact('total_fine', 'total_asset', 'current_due', 'total_fee_collection', 'total_income', 'total_expense', 'total_deposit', 'total_withdraw'));
    }

    public function account_report(){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $funds = Fund::where('status', 1)->get();
      return view('backEnd.accounts.account_report', compact('funds', 'classes', 'groups'));
    }

    public function date_wise_fund_report(Request $request){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $funds = Fund::where('status', 1)->get();
      $return_fund = Fund::find($request->fund_id);
      $fee_fund = FeeCollection::where('school_id', Auth::getSchool())->where('fund_id', $request->fund_id)->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('paid');
      $fee_fund_due = FeeCollection::where('school_id', Auth::getSchool())->where('fund_id', $request->fund_id)->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('due');
      $fee_fund_due_paid = FeeCollection::where('school_id', Auth::getSchool())->where('fund_id', $request->fund_id)->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('due_paid');
      $income_fund = Income::where('school_id', Auth::getSchool())->where('fund_id', $request->fund_id)->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('amount');
      $expense_fund = Expense::where('school_id', Auth::getSchool())->where('fund_id', $request->fund_id)->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('amount');
      $fund_balance = ($fee_fund+$fee_fund_due_paid+$income_fund)-($fee_fund_due+$expense_fund);
      // return $fund_balance;
      return view('backEnd.accounts.account_report', compact('funds', 'return_fund', 'fee_fund', 'fee_fund_due', 'fee_fund_due_paid', 'income_fund', 'expense_fund', 'fund_balance', 'classes', 'groups'));
    }

    public function date_wise_fee_collection_report(Request $request){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $funds = Fund::where('status', 1)->get();
      $date_fee_collection = FeeCollection::where('school_id', Auth::getSchool())->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('paid');
      $date_fee_collection_due = FeeCollection::where('school_id', Auth::getSchool())->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('due');
      $date_fee_collection_due_paid = FeeCollection::where('school_id', Auth::getSchool())->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('due_paid');
      return view('backEnd.accounts.account_report', compact('funds', 'date_fee_collection', 'date_fee_collection_due', 'date_fee_collection_due_paid', 'classes', 'groups'));
    }

    public function date_wise_income_report(Request $request){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $funds = Fund::where('status', 1)->get();
      $total_income = Income::where('school_id', Auth::getSchool())->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('amount');
      // return $income_fund;
      return view('backEnd.accounts.account_report', compact('funds','total_income', 'classes', 'groups'));
    }

    public function date_wise_expense_report(Request $request){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $funds = Fund::where('status', 1)->get();
      $total_expense = Expense::where('school_id', Auth::getSchool())->whereDate('payment_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('payment_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('amount');
      // return $income_fund;
      return view('backEnd.accounts.account_report', compact('funds','total_expense', 'classes', 'groups'));
    }

    public function class_wise_fee_collection_report(Request $request){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $funds = Fund::where('status', 1)->get();
      $students = Student::where('school_id', Auth::getSchool())
                        ->where('master_class_id', $request->master_class_id)
                        ->where('group', $request->group_class_id)
                        ->where('shift', $request->shift)
                        ->select('id')->get();
      // return $students;
      $total_fee_collection = FeeCollection::where('school_id', Auth::getSchool())->whereIn('student_id', $students)->sum('paid');
      $fee_collection_due = FeeCollection::where('school_id', Auth::getSchool())->whereIn('student_id', $students)->sum('due');
      $fee_collection_due_paid = FeeCollection::where('school_id', Auth::getSchool())->whereIn('student_id', $students)->sum('due_paid');
      // return $fee_collection_due;
      return view('backEnd.accounts.account_report', compact('funds', 'total_fee_collection', 'fee_collection_due', 'fee_collection_due_paid', 'classes', 'groups'));
    }

    public function date_wise_bank_report(Request $request){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $funds = Fund::where('status', 1)->get();
      $total_deposit = BankDeposit::where('school_id', Auth::getSchool())->whereDate('deposit_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('deposit_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('amount');
      $total_withdraw = BanksWithdraw::where('school_id', Auth::getSchool())->whereDate('withdra_date', '>=', date('Y-m-d', strtotime($request->start_date)))->whereDate('withdra_date', '<=', date('Y-m-d', strtotime($request->end_date)))->sum('amount');
      // return $fee_collection_due;
      return view('backEnd.accounts.account_report', compact('funds', 'total_deposit', 'total_withdraw', 'classes', 'groups'));
    }



}
