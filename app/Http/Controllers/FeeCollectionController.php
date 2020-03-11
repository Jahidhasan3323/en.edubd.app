<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SmsSendController;
use App\MasterClass;
use App\GroupClass;
use App\Unit;
use App\Student;
use App\School;
use App\FeeSetup;
use App\FeeCollection;
use App\FeeCategory;
use App\Fund;
use App\AccountSetting;
use App\User;
use App\SmsReport;
use App\SmsLimit;

class FeeCollectionController extends Controller
{
    public function fee_collection_add(){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $units = $this->getUnits();
      $fee_categories = FeeCategory::where('status', 1)->get();
      $funds = Fund::where('status', 1)->get();
      return view('backEnd.accounts.fee_collection.add', compact('classes', 'groups', 'units', 'fee_categories', 'funds'));
    }

    public function get_st_id(Request $request){
      $students = Student::where('school_id', Auth::getSchool())
                        ->where('master_class_id', $request->master_class_id)
                        ->where('group', $request->group_class_id)
                        ->where('shift', $request->shift)
                        ->where('section', $request->section)
                        ->current()
                        ->get();
      return $students;
    }
    public function get_fee_cat_amount(Request $request){
      $student = Student::find($request->student_id);
      $group = GroupClass::where('name', $student->group)->first();
      $fee_category = FeeSetup::where('school_id', Auth::getSchool())
                        ->where('master_class_id', $student->master_class_id)
                        ->where('group_class_id', $group->id)
                        ->where('shift', $student->shift)
                        ->where('fee_category_id', $request->fee_cat_id)
                        ->first();
      if ($fee_category) {
        $view_id = substr($request->fee_view_id, 8);
        $data = array("view_id" => $view_id, "fee_amount" => $fee_category->amount);
        return json_encode($data);
      }else {
        $view_id = substr($request->fee_view_id, 8);
        $data = array("view_id" => $view_id, "fee_amount" => "ফি নির্ধারণ করুন");
        return json_encode($data);
      }
    }

    public function fee_student_search(Request $request){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $units = $this->getUnits();
      $fee_categories = FeeCategory::where('status', 1)->get();
      $funds = Fund::where('status', 1)->get();
      $student = Student::where('master_class_id', $request->master_class_id)
                        ->where('group', $request->group_class_id)
                        ->where('shift', $request->shift)
                        ->where('section', $request->section)
                        ->where('roll', $request->roll)
                        ->current()
                        ->first();
      // return $student;
      $fee_status = FeeCollection::orderBy('id', 'desc')->where('student_id', $student->id)->first();
      $due = FeeCollection::where('student_id', $student->id)->sum('due');
      $due_paid = FeeCollection::where('student_id', $student->id)->sum('due_paid');
      $current_due = ($due - $due_paid);
      $fee_collection_form = "";
      if (empty($student)) {
        return redirect()->back()->with('error_msg', 'শিক্ষার্থী খুজে পাওয়া যায়নি ।');
      }
      return view('backEnd.accounts.fee_collection.add', compact('fee_collection_form', 'classes', 'groups', 'units', 'fee_categories', 'funds', 'student', 'fee_status', 'current_due'));
    }

    public function fee_collection_store(Request $request, SmsSendController $shorter){
      $this->validate($request, [
        "fee_cats" => "required",
        "payment_date" => "required",
        "paid" => "required",
        "payment_method" => "required",
        "payment_by" => "required|string|max:100",
      ]);
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $units = $this->getUnits();
      $fee_categories = FeeCategory::where('status', 1)->get();
      $funds = Fund::where('status', 1)->get();

      $student_fee = Student::find($request->student_id);
      $group = GroupClass::where('name', $student_fee->group)->first();
      $fee_cats = array_filter($request->fee_cats);

      if (count($fee_cats) > 0) {
        $fees = FeeSetup::where('school_id', Auth::getSchool())
                        ->where('master_class_id', $student_fee->master_class_id)
                        ->where('group_class_id', $group->id)
                        ->where('shift', $student_fee->shift)
                        ->whereIn('fee_category_id', $fee_cats)
                        ->get();
        if (count($fees) < 1 ) {
          return redirect()->route('fee_collection_add')->with('error_msg', 'ফি কালেকশনের পূর্বে ক্যাটাগরি ভিত্তিক ফি এর পরিমান নির্ধারন করুন।');
        }
      }

      $total_amount = 0;
      foreach ($fees as $key => $fee) {
        $total_amount += $fee->amount;
      }
      // Total Waiver
      $total_waiver = 0;
      foreach ($request->waivers as $key => $waiver) {
        $total_waiver += $waiver;
      }
      // Payable Amount
      $amount = $total_amount-$total_waiver;
      // Total Due
      $due = $amount - $request->paid;
      // return $due;
      $last_fee = FeeCollection::orderBy('id', 'desc')->first();
      if ($last_fee) {
        $serial = $last_fee->serial+1;
      }else {
        $serial = date('Y')."10000";
      }
      $fee_collection = new FeeCollection;
      $data = $request->except(['payment_date', 'fee_cats', 'waivers']);
      $data['school_id'] = Auth::getSchool();
      $data['serial'] = $serial;
      $data['fee_category'] = json_encode($fee_cats);
      $data['payment_date'] = date('Y-m-d', strtotime($request->payment_date));
      $data['amount'] = $amount;
      $data['waiver'] = $total_waiver;
      $data['due'] = $due;
      $fee_collection->create($data);

      $view_collection = FeeCollection::where('serial', $serial)->first();
      $fee_categories = FeeSetup::where('school_id', Auth::getSchool())->whereIn('fee_category_id', json_decode($view_collection->fee_category))->get();
      // return $fee_categories;
      $student = Student::find($view_collection->student_id);
      $group = GroupClass::where('name', $student->group)->first();
      $due = FeeCollection::where('student_id', $student->id)->sum('due');
      $due_paid = FeeCollection::where('student_id', $student->id)->sum('due_paid');
      $current_due = ($due - $due_paid);
      // SMS Sending Code
      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      if (empty($account_setting)) {
        return redirect()->route('fee_collection_add')->with('error_msg', 'ফি কালেকশনের পূর্বে ভাউচারের শিরোনাম, এস,এম,এস ইত্যাদি একাউন্ট  সেটিংসে যোগ করুন ।');
      }
      $student_name = User::find($student->user_id);
      $school=$this->school();
      $sms_limit = SmsLimit::where('school_id', $school->id)->first();
      $sms_limit = $sms_limit?$sms_limit->fee_collection:'0';
      $sms_report = SmsReport::where('school_id', Auth::getSchool())->where('sms_type', 4)->where('student_id', $student->id)->whereYear('date', date('Y'))->whereMonth('date', date('m'))->count();
      $school_name = ($school->short_name==NULL) ? $shorter->school_name_process(Auth::user()->name) : $school->short_name;
      if ($school->sms_service==0) {
          if ($account_setting->fee_coolection_sms=="1") {
            if (!empty($request->mobile)) {
              $mobile_number = "88".$request->mobile;
              $total_paid_amount = $amount+$due_paid;
              $message = urlencode($student_name->name.", মেমো নাম্বার-".$serial.", জমা-".$total_paid_amount."/-, ".date('d M Y h:i a').$school_name);
              $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
            }
          }
      }else {
          if ($sms_report < $sms_limit) {
            if (!empty($request->mobile)) {
              $mobile_number = "88".$request->mobile;
              $total_paid_amount = $amount+$due_paid;
              $message = urlencode($student_name->name.", মেমো নাম্বার-".$serial.", জমা-".$total_paid_amount."/-, ".date('d M Y h:i a').$school_name);
              $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
              $success = json_decode($send_sms,true);
              if ($success['error']==0) {
                  $sms = new SmsReport;
                  $sms->sms_type = 4;
                  $sms->student_id = $student->id;
                  $sms->date = now();
                  $sms->save();
              }
            }
          }
      }

      return view('backEnd.accounts.fee_collection.add', compact('classes', 'groups', 'units', 'fee_categories', 'funds',
       'view_collection', 'fees', 'student_fee', 'school', 'student', 'group', 'current_due', 'account_setting'));
    }

    public function fee_collection_manage(){
      $fee_collections = FeeCollection::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.fee_collection.manage', compact('fee_collections'));
    }

    public function fee_collection_view($id){
      $fee_collection = FeeCollection::find($id);
      $fee_categories = FeeSetup::where('school_id', Auth::getSchool())->whereIn('fee_category_id', json_decode($fee_collection->fee_category))->get();
      // return $fee_categories;
      $school = School::find(Auth::getSchool());
      $student = Student::find($fee_collection->student_id);
      $group = GroupClass::where('name', $student->group)->first();
      $due = FeeCollection::where('student_id', $student->id)->sum('due');
      $due_paid = FeeCollection::where('student_id', $student->id)->sum('due_paid');
      $current_due = ($due - $due_paid);
      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      return view('backEnd.accounts.fee_collection.view', compact('fee_collection', 'fee_categories', 'student', 'group', 'current_due', 'school', 'account_setting'));
    }

    public function fee_collection_delete(Request $request){
      $fee_collection = FeeCollection::find($request->id);
      $fee_collection->delete();
      return redirect()->back()->with('success_msg', 'ফি কালেকশন সফলভাবে মুছে ফেলা হয়েছে ।');
    }

    public function due_sms(){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $units = $this->getUnits();
      return view('backEnd.accounts.fee_collection.due_sms', compact('classes', 'groups', 'units'));
    }

    public function send_due_sms(Request $request, SmsSendController $shorter){
        $students = Student::where('school_id', Auth::getSchool())
                            ->where('master_class_id', $request->master_class_id)
                            ->where('group',$request->group_class_id)
                            ->where('shift',$request->shift)
                            ->where('section',$request->section)
                            ->current()
                            ->get();
        $school = School::find(Auth::getSchool());
        $sms_limit = SmsLimit::where('school_id', $school->id)->first();
        $sms_limit = $sms_limit?$sms_limit->due_sms:'0';
        $school_name = $shorter->school_name_process(Auth::user()->name);
        $error = array();
        $end_limit = array();
        $msg = "";
        if (!empty($school->api_key) && !empty($school->sender_id)) {
            foreach ($students as $student) {
                $sms_report = SmsReport::where('school_id', Auth::getSchool())->where('sms_type', 4)->where('student_id', $student->id)->whereYear('date', date('Y'))->whereMonth('date', date('m'))->count();
                $total_due = FeeCollection::where('school_id',Auth::getSchool())->where('student_id', $student->id)->sum('due');
                $total_due_paid = FeeCollection::where('school_id',Auth::getSchool())->where('student_id', $student->id)->sum('due_paid');
                $current_due = $total_due-$total_due_paid;
                if ($school->sms_service==0) {
                    if ($current_due > 0) {
                        $number = $student->f_mobile_no??$student->m_mobile_no;
                        if (!empty($number)) {
                            $mobile_number = "88".$number;
                            $message = 'আপনার সন্তান '.$student->user->name.',শ্রেণী-'.$student->masterClass->name.', রোল-'.$student->roll.' এর '.$current_due.' টাকা বকেয়া রয়েছে '.$school_name;
                            $message = urlencode($message);
                            $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
                            $msg = "বকেয়া এস,এম,এস সফলভাবে পাঠানো হয়েছে ।";
                        }else {
                            $error[] = $student->user->name;
                        }
                    }
                }else {
                    if ($sms_report < $sms_limit) {
                        if ($current_due > 0) {
                            $number = $student->f_mobile_no??$student->m_mobile_no;
                            if (!empty($number)) {
                                $mobile_number = "88".$number;
                                $message = 'আপনার সন্তান '.$student->user->name.',শ্রেণী-'.$student->masterClass->name.', রোল-'.$student->roll.' এর '.$current_due.' টাকা বকেয়া রয়েছে '.$school_name;
                                $message = urlencode($message);
                                $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
                                $success = json_decode($send_sms,true);
                                if ($success['error']==0) {
                                    $sms = new SmsReport;
                                    $sms->sms_type = 4;
                                    $sms->student_id = $student->id;
                                    $sms->date = now();
                                    $sms->save();
                                }
                                $msg = "বকেয়া এস,এম,এস সফলভাবে পাঠানো হয়েছে ।";
                            }else {
                                $error[] = $student->user->name;
                            }
                        }
                    }else {
                        $end_limit[] = $student->user->name;
                    }
                }
            }

        }else {
            $msg = "এস,এম,এস এ,পি,আই এবং সেন্ডার আইডি সেটাপ করুন ।";
        }
        return redirect()->route('due_sms')->with('success_msg',[$msg,$error,$end_limit]);
    }




}
