<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SmsSendController;
use App\Fund;
use App\Expense;
use App\School;
use App\AccountSetting;
use App\User;
use App\SmsReport;
use App\SmsLimit;
use Auth;

class ExpenseController extends Controller
{
    public function expense_add(){
      $funds = Fund::orderBy('id', 'asc')->get();
      return view('backEnd.accounts.expense.add', compact('funds'));
    }

    public function expense_store(Request $request,  SmsSendController $shorter){
      $this->validate($request, [
        "received_by" => "required|string|max:191",
        "amount" => "required",
        "payment_date" => "required",
      ]);
      $last_expense = Expense::orderBy('id', 'desc')->first();
      if ($last_expense) {
        $serial = $last_expense->serial+1;
      }else {
        $serial = date('Y')."10000";
      }

      $expense = new Expense;
      $data = $request->except(['payment_date']);
      $data['school_id'] = Auth::getSchool();
      $data['serial'] = $serial;
      $data['payment_date'] = date('Y-m-d', strtotime($request->payment_date));
      // return $data;
      $expense->create($data);

      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      $school=$this->school();
      $sms_limit = SmsLimit::where('school_id', $school->id)->first();
      $sms_limit = $sms_limit?$sms_limit->expense:'0';
      $sms_report = SmsReport::where('school_id', Auth::getSchool())->where('sms_type', 7)->whereYear('date', date('Y'))->whereMonth('date', date('m'))->count();
      $school_name = ($school->short_name==NULL) ? $shorter->school_name_process($school->user->name) : $school->short_name;
      if ($school->sms_service==0) {
          if ($account_setting->income_sms=="1") {
            if (!empty($request->mobile)) {
              $mobile_number = "88".$request->mobile;
              $message = urlencode($request->received_by.", মেমো নাম্বার-".$serial.", খরচ-".$request->amount." /-, ".date('d M Y h:i a ').$school_name);
              $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
            }
          }
      }else {
          if ($sms_report < $sms_limit) {
              if (!empty($request->mobile)) {
                $mobile_number = "88".$request->mobile;
                $message = urlencode($request->received_by.", মেমো নাম্বার-".$serial.", খরচ-".$request->amount." /-, ".date('d M Y h:i a ').$school_name);
                $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
                $success = json_decode($send_sms,true);
                if ($success['error']==0) {
                    $sms = new SmsReport;
                    $sms->sms_type = 7;
                    $sms->student_id = null;
                    $sms->date = now();
                    $sms->save();
                }
              }
          }
      }
      $expense_view = Expense::where('serial', $serial)->first();
      $funds = Fund::orderBy('id', 'asc')->get();
      $msg = 'খরচ সফলভাবে যোগ করা হয়েছে ।';
      return view('backEnd.accounts.expense.add', compact('funds', 'expense_view', 'msg', 'school', 'account_setting'));
    }

    public function expense_manage(){
      $expenses = Expense::orderBy('id', 'DESC')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.expense.manage', compact('expenses'));
    }

    public function expense_edit($id){
      $funds = Fund::orderBy('id', 'asc')->get();
      $expense = Expense::find($id);
      return view('backEnd.accounts.expense.edit', compact('expense', 'funds'));
    }

    public function expense_update(Request $request){
      $this->validate($request, [
        "received_by" => "required|string|max:191",
        "amount" => "required",
        "payment_date" => "required",
      ]);
      $expense = Expense::find($request->id);
      $data = $request->except(['payment_date']);
      $data['payment_date'] = date('Y-m-d', strtotime($request->payment_date));
      // return $data;
      $expense->update($data);
      return redirect()->route('expense_manage')->with('success_msg', 'খরচ সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function expense_view($id){
      $school = School::find(Auth::getSchool());
      $expense = Expense::find($id);
      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      return view('backEnd.accounts.expense.view', compact('school', 'expense', 'account_setting'));
    }

    public function expense_delete(Request $request){
      $expense = Expense::find($request->id);
      $expense->delete();
      return redirect()->back()->with('success_msg', 'খরচ সফলভাবে মুছে ফেলা হয়েছে ।');
    }

}
