<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SmsSendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_notification_for_absend($numbers)
    {
        $numberArray = $this->validateNumber($numbers);
        return implode(',', $numberArray);
    }

    public function send_notification_for_present($numbers)
    {
        $numberArray = $this->validateNumber($numbers);
        return $numberArray;
    }


    public function send_for_teacher($teachers)
    {
        foreach ($teachers as $teacher) {
                   $numbers[] = $teacher->user->mobile;
               }
        $numberArray = $this->validateNumber($numbers);

        return $numberArray;
    }

    public function send_for_student($numbers)
    {
        $numberArray = $this->validateNumber($numbers);

        return $numberArray;
    }

    public function school_name_process($name)
    {
        if (Auth::user()->group_id!=1) {
            $school=$this->school();
            if($school->short_name!=NULL){
                return $school->short_name;
            }
        }

        $school_words=explode(' ',$name);
        foreach ($school_words as $key => $school_word) {
           $school_name_arr[$key]=substr($school_word, 0,6).':';
        }
        return implode(' ', $school_name_arr);
    }


    public function validateNumber($numbers)
    {
      $numberArray=array();
        foreach ($numbers as $value) {
                   $number = trim($value);
                    if ( !is_numeric($number) ){
                      continue;
                    }else if ( !( (substr($number,0,4) == "8801" && strlen($number) == 13) || (substr($number,0,2) == "01" && strlen($number) == 11) || ( substr($number,0,1) == "1" && strlen($number) == 10 ) ) ){
                      continue;
                    }


                    $opId = substr($number,0,1);
                    if($opId=='8'){
                      $numberCheck = substr($number,0,5);
                      $phone_number = $number;
                    }elseif($opId=='0'){
                      $numberCheck = substr('88'.$number,0,5);
                      $phone_number = '88'.$number;
                    }elseif ($opId=='1') {
                      $numberCheck = substr('880'.$number,0,5);
                      $phone_number = '880'.$number;
                    }

            // ------invalid number check--------------
                    if( (substr($phone_number,0,5) != "88013") && (substr($phone_number,0,5) != "88014") && (substr($phone_number,0,5) != "88015") && (substr($phone_number,0,5) != "88016") && (substr($phone_number,0,5) != "88017") && (substr($phone_number,0,5) != "88018") && (substr($phone_number,0,5) != "88019")){
                      continue;
                    }

                    $numberArray[]=$phone_number;

                }
                return $numberArray;
    }

}
