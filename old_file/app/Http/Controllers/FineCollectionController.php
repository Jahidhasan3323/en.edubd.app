<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FineCollection;
use App\AccountSetting;
use App\School;
use App\Student;
use App\AttenStudent;
use App\GroupClass;
use App\Holiday;
use App\FineSetup;
use App\Fund;
use App\SmsLimit;
use App\SmsReport;
use Auth;

class FineCollectionController extends Controller
{
    public function fine_collection_add(){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $units = $this->getUnits();
      $funds = Fund::orderBy('id', 'asc')->get();
      return view('backEnd.accounts.fine_collection.add', compact('funds', 'classes', 'groups', 'units'));
    }

    public function fine_student_search(Request $request){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $units = $this->getUnits();
      $funds = Fund::where('status', 1)->get();
      $student = Student::where('id', $request->student_id)
                        ->first();
      $student_group_id = GroupClass::where('name', $student->group)->first()->id;
      // Fine Generate
      $last_fine_collection = FineCollection::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->where('student_id', $student->id)->first();
      $current_month_fine_collection = FineCollection::where('school_id', Auth::getSchool())->where('student_id', $student->id)->whereMonth('payment_date', date('m'))->whereYear('payment_date', date('Y'))->sum('amount');
      $total_attend = AttenStudent::where('school_id', Auth::getSchool())->where('student_id', $student->student_id)->whereMonth('date', date('m', strtotime('-1 months')))->whereYear('date', date('Y'))->where('status','P')->count();
      $total_holiday = Holiday::whereIn('school_id',[ Auth::getSchool(),0])->whereMonth('date', date('m', strtotime('-1 months')))->whereYear('date', date('Y'))->count();
      $all_dates=array();
      $month = date('m', strtotime('-1 months'));
      $year = date('Y');
      for($d=1; $d<=31; $d++)
      {
          $time=mktime(12, 0, 0, $month, $d, $year);
          if (date('m', $time)==$month)
          $all_dates[]=date('Y-m-d-D', $time);
          if (date('D', $time)=="Fri") {
            $fridays[]=date('Y-m-d-D', $time);
          }
      }
      $fine = FineSetup::where('school_id', Auth::getSchool())
                        ->where('master_class_id', $student->master_class_id)
                        ->where('group_class_id', $student_group_id)
                        ->where('shift', $request->shift)
                        ->first()->amount;
      $absense = count($all_dates)-($total_attend+$total_holiday);
      // return $absense;
      if (empty($fine)) {
        return redirect()->back()->with('error_msg', 'Please setup fine before collecting fine !');
      }
      return view('backEnd.accounts.fine_collection.add', compact('student', 'absense', 'fine', 'last_fine_collection','current_month_fine_collection', 'funds', 'classes', 'groups', 'units'));
    }

    public function fine_collection_store(Request $request, SmsSendController $shorter){
      $this->validate($request, [
        "payment_by" => "required|string|max:191",
        "amount" => "required",
        "paid" => "required",
        "payment_date" => "required",
      ]);
      $last_fine_collection = FineCollection::orderBy('id', 'desc')->first();
      if ($last_fine_collection) {
        $serial = $last_fine_collection->serial+1;
      }else {
        $serial = date('Y')."10000";
      }

      $fine_collection = new FineCollection;
      $data = $request->except(['payment_date']);
      $data['school_id'] = Auth::getSchool();
      $data['serial'] = $serial;
      $data['due'] = $request->amount-($request->paid+$request->waiver);
      $data['payment_date'] = date('Y-m-d', strtotime($request->payment_date));
      // return $data;
      $fine_collection->create($data);

      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      $school=$this->school();
      $school_name = ($school->short_name==NULL) ? $shorter->school_name_process($school->user->name) : $school->short_name;
      $sms_limit = SmsLimit::where('school_id', $school->id)->first();
      $sms_limit = $sms_limit?$sms_limit->fine_collection:'0';
      $error = array();
      $end_limit = array();
      $msg = "";
      if (!empty($school->api_key) && !empty($school->sender_id)) {
          foreach ($students as $student) {
              $sms_report = SmsReport::where('school_id', Auth::getSchool())->where('sms_type', 5)->where('student_id', $student->id)->whereYear('date', date('Y'))->whereMonth('date', date('m'))->count();
              if ($school->sms_service==0) {
                  if ($account_setting->fine_collection_sms=="1") {
                      $number = $student->f_mobile_no??$student->m_mobile_no;
                      if (!empty($number)) {
                          $mobile_number = "88".$number;
                          $message = $request->payment_by.", Memo No-".$serial.", Paid-".$request->paid." /-, ".date('d M Y h:i a ').$school_name;
                          $message = urlencode($message);
                          // $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
                          $msg = "Fine Collection SMS send Successfully.";
                      }else {
                          $error[] = $student->user->name;
                      }
                  }
              }else {
                  if ($sms_report < $sms_limit) {
                      if ($total_fine > 0) {
                          $number = $request->mobile;
                          if (!empty($number)) {
                              $mobile_number = "88".$number;
                              // $mobile_number = "8801729890904";
                              $message = $request->payment_by.", Memo Number-".$serial.", Paid-".$request->paid." /-, ".date('d M Y h:i a ').$school_name;
                              $message = urlencode($message);
                              $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
                              $success = json_decode($send_sms,true);
                              if ($success['error']==0) {
                                  $sms = new SmsReport;
                                  $sms->sms_type = 5;
                                  $sms->student_id = $student->id;
                                  $sms->date = now();
                                  $sms->save();
                              }
                              $msg = "Fine Collection SMS send Successfully.";
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
          $msg = "Please setup SMS API & Sender ID.";
      }
      $fine_collection_view = FineCollection::where('serial', $serial)->first();
      $student = Student::find($request->student_id);
      $funds = Fund::orderBy('id', 'asc')->get();
      $msg = 'Fine Collection Added Successfully.';
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $units = $this->getUnits();
      $funds = Fund::orderBy('id', 'asc')->get();
      return view('backEnd.accounts.fine_collection.add', compact('funds', 'fine_collection_view', 'msg', 'school', 'account_setting', 'student', 'funds', 'classes', 'groups', 'units'));
    }

    public function fine_collection_manage(){
      $fine_collections = FineCollection::orderBy('id', 'DESC')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.fine_collection.manage', compact('fine_collections'));
    }


    public function fine_collection_view($id){
      $school = School::find(Auth::getSchool());
      $fine_collection = FineCollection::find($id);
      $student = Student::find($fine_collection->student->id);
      $account_setting = AccountSetting::where('school_id', Auth::getSchool())->first();
      return view('backEnd.accounts.fine_collection.view', compact('student', 'school', 'fine_collection', 'account_setting'));
    }

    public function fine_collection_delete(Request $request){
      $fine_collection = FineCollection::find($request->id);
      $fine_collection->delete();
      return redirect()->back()->with('success_msg', 'Fine Collection Deleted Successfully.');
    }

    public function fine_sms(){
      $classes = $this->getClasses();
      $groups = $this->groupClasses();
      $units = $this->getUnits();
      return view('backEnd.accounts.fine_collection.fine_sms', compact('classes', 'groups', 'units'));
    }

    public function send_fine_sms(Request $request, SmsSendController $shorter){
        $students = Student::where('school_id', Auth::getSchool())
                            ->where('master_class_id', $request->master_class_id)
                            ->where('group',$request->group_class_id)
                            ->where('shift',$request->shift)
                            ->where('section',$request->section)
                            ->current()
                            ->get();
        $school = School::find(Auth::getSchool());
        $school_name = ($school->short_name==NULL) ? $shorter->school_name_process($school->user->name) : $school->short_name;
        $sms_limit = SmsLimit::where('school_id', $school->id)->first();
        $sms_limit = $sms_limit?$sms_limit->fine_due_sms:'0';
        $error = array();
        $end_limit = array();
        $msg = "";
        if (!empty($school->api_key) && !empty($school->sender_id)) {
            foreach ($students as $student) {
                $sms_report = SmsReport::where('school_id', Auth::getSchool())->where('sms_type', 8)->where('student_id', $student->id)->whereYear('date', date('Y'))->whereMonth('date', date('m'))->count();
                $total_fine = FineCollection::orderBy('id','desc')->where('school_id', Auth::getSchool())->where('student_id', $student->id)->first();
                $total_fine = $total_fine?$total_fine->due:'0';
                if ($school->sms_service==0) {
                    if ($total_fine > 0) {
                        $number = $student->f_mobile_no??$student->m_mobile_no;
                        if (!empty($number)) {
                            $mobile_number = "88".$number;
                            $message = 'Your son '.$student->user->name.',Class-'.$student->masterClass->name.', Roll-'.$student->roll.' Fine due amount '.$total_fine.' Taka '.$school_name;
                            $message = urlencode($message);
                            $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
                            $msg = "Fine due SMS send Successfully.";
                        }else {
                            $error[] = $student->user->name;
                        }
                    }
                }else {
                    if ($sms_report < $sms_limit) {
                        if ($total_fine > 0) {
                            $number = $student->f_mobile_no??$student->m_mobile_no;
                            if (!empty($number)) {
                                $mobile_number = "88".$number;
                                // $mobile_number = "8801729890904";
                                $message = 'Your son '.$student->user->name.',Class-'.$student->masterClass->name.', Roll-'.$student->roll.' fine due amount '.$total_fine.' Taka '.$school_name;
                                $message = urlencode($message);
                                $send_sms = $this->sms_send_by_api($school,$mobile_number,$message);
                                $success = json_decode($send_sms,true);
                                if ($success['error']==0) {
                                    $sms = new SmsReport;
                                    $sms->sms_type = 8;
                                    $sms->student_id = $student->id;
                                    $sms->date = now();
                                    $sms->save();
                                }
                                $msg = "Fine due sms send successfull.";
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
            $msg = "Please setup SMS api & sender ID.";
        }
        if (!isset($msg)) {
            $msg = "Fine due not found !";
        }
        return redirect()->route('fine_sms')->with('success_msg',[$msg,$error,$end_limit]);
    }


}
