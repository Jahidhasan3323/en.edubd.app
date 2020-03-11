<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SmsSendController;
use App\Fund;
use App\Income;
use App\School;
use App\AccountSetting;
use App\User;
use App\SmsReport;
use App\SmsLimit;
use Auth;

class IncomeController extends Controller
{
    public function income_add(){
      $funds = Fund::orderBy('id', 'asc')->get();
      return view('backEnd.accounts.income.add', compact('funds'));
    }

    public function income_store(Request $request, SmsSendController $shorter){
      $this->validate($request, [
        "payment_by" => "required|string|max:191",
        "amount" => "required",
        "payment_date" => "required",
        "fund_id" => "required",
      ]);
      $last_income = Income::orderBy('id', 'desc')->first();
      if ($last_income) {
        $serial = $last_income->serial+1;
      }else {
        $serial = date('Y')."10000";
      }

      $income = new Income;
      $data = $request->except(['payment_date']);
      $data['school_id'] = Auth::getSchool();
      $data['serial'] = $serial;
      $data['payment_date'] = date('Y-m-d', strtotime($request->payment_date));
      // return $data;
      $income->create($data);

      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      $school=$this->school();
      $sms_limit = SmsLimit::where('school_id', $school->id)->first();
      $sms_limit = $sms_limit?$sms_limit->income:'0';
      $sms_report = SmsReport::where('school_id', Auth::getSchool())->where('sms_type', 6)->whereYear('date', date('Y'))->whereMonth('date', date('m'))->count();
      $school_name = ($school->short_name==NULL) ? $shorter->school_name_process($school->user->name) : $school->short_name;
      if ($school->sms_service==0) {
          if ($account_setting->income_sms=="1") {
            if (!empty($request->mobile)) {
              $mobile_number = "88".$request->mobile;
              $message = urlencode($request->payment_by.", মেমো নাম্বার-".$serial.", জমা-".$request->amount." /-, ".date('d M Y h:i a ').$school_name);
              $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
            }
          }
      }else {
          if ($sms_report < $sms_limit) {
              if (!empty($request->mobile)) {
                $mobile_number = "88".$request->mobile;
                $message = urlencode($request->payment_by.", মেমো নাম্বার-".$serial.", জমা-".$request->amount." /-, ".date('d M Y h:i a ').$school_name);
                $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
                $success = json_decode($send_sms,true);
                if ($success['error']==0) {
                    $sms = new SmsReport;
                    $sms->sms_type = 6;
                    $sms->student_id = null;
                    $sms->date = now();
                    $sms->save();
                }
              }
          }
      }

      $income_view = Income::where('serial', $serial)->first();
      $funds = Fund::orderBy('id', 'asc')->get();
      $msg = 'আয় সফলভাবে যোগ করা হয়েছে ।';
      return view('backEnd.accounts.income.add', compact('funds', 'income_view', 'msg', 'school', 'account_setting'));
    }

    public function income_manage(){
      $incomes = Income::orderBy('id', 'DESC')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.income.manage', compact('incomes'));
    }

    public function income_edit($id){
      $income = Income::find($id);
      $funds = Fund::orderBy('id', 'asc')->get();
      return view('backEnd.accounts.income.edit', compact('income', 'funds'));
    }

    public function income_update(Request $request){
      $this->validate($request, [
        "payment_by" => "required|string|max:191",
        "amount" => "required",
        "payment_date" => "required",
      ]);
      $income = Income::find($request->id);
      $data = $request->except(['payment_date']);
      $data['payment_date'] = date('Y-m-d', strtotime($request->payment_date));
      // return $data;
      $income->update($data);
      return redirect()->route('income_manage')->with('success_msg', 'আয় সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function income_view($id){
      $school = School::find(Auth::getSchool());
      $income = Income::find($id);
      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      return view('backEnd.accounts.income.view', compact('school', 'income', 'account_setting'));
    }

    public function income_delete(Request $request){
      $income = Income::find($request->id);
      $income->delete();
      return redirect()->back()->with('success_msg', 'আয় সফলভাবে মুছে ফেলা হয়েছে ।');
    }



}
