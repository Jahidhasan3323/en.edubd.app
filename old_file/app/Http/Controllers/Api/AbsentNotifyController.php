<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\AttenStudent;
use App\AttenEmployee;
use App\Staff;


class AbsentNotifyController extends Controller
{
    public function send(){
      $numbers = AttenStudent::where(['date'=>date('d-m-Y'),'school_id'=>5])->get();
      $ids =array();
      foreach($numbers as $number){
        $ids[]=$number->student_id;
      }
      $students = Student::with('user')->whereNotIn('student_id',$ids)->where(['school_id'=>5])->get();
        foreach($students as $student){
        	$text =$student->user->name.' অনুপস্থিত #SPHS @Ehsan Software';
        	$text=urlencode($text);
            if($student->f_mobile_no!=NULL){
              $url_AllNumber="https://api.mobireach.com.bd/SendTextMultiMessage?Username=esoftware&Password=Abcd@4321&From=8801847121242&To=88".$student->f_mobile_no."&Message=".$text;
              $res = $this->send_sms_by_curl($url_AllNumber);
           }
        }
    }

    protected function send_sms_by_curl($url_AllNumber){
           $ch_banpage = curl_init($url_AllNumber);
           curl_setopt($ch_banpage, CURLOPT_URL, $url_AllNumber);
           curl_setopt($ch_banpage, CURLOPT_HEADER, 0);
           curl_setopt($ch_banpage, CURLOPT_RETURNTRANSFER, true);
           $res = curl_exec($ch_banpage);
           curl_close($ch_banpage); 
           return $res;
    }

    public function send_for_staff(){
      $numbers = AttenEmployee::where(['date'=>date('d-m-Y'),'school_id'=>5])->get();
      $ids =array();
      foreach($numbers as $number){
        $ids[]=$number->staff_id;
      }
      $staffs = Staff::with('user')->whereNotIn('staff_id',$ids)->where(['school_id'=>5])->get();
        foreach($staffs as $staff){
          $text =$staff->user->name.' অনুপস্থিত #SPHS @Ehsan Software';
          $text=urlencode($text);
            if($staff->user->mobile!=NULL){
              $url_AllNumber="https://api.mobireach.com.bd/SendTextMultiMessage?Username=esoftware&Password=Abcd@4321&From=8801847121242&To=88".$staff->user->mobile."&Message=".$text;
              $res = $this->send_sms_by_curl($url_AllNumber);
           }
        }
    }
}
