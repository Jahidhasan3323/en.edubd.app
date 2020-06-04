<?php
namespace App\Custom;

use Illuminate\Http\Request;
use Auth;

class BirthdayNumber{
    public static function get_numbers($students,$staffs,$committees){
        $numbers = array();
        foreach ($students as $student) {
            $date = date('m-d',strtotime($student->birthday));
            // echo $date.'='.date('m-d').', ';
            if ($date == date('m-d')) {
                if ($student->f_mobile_no) {
                    $numbers[] = '88'.$student->f_mobile_no;
                }elseif ($student->m_mobile_no) {
                    $numbers[] = '88'.$student->m_mobile_no;
                }elseif($student->user->mobile) {
                    $numbers[] = '88'.$student->user->mobile;
                }
            }

        }
        foreach ($staffs as $staff) {
            $date = date('m-d',strtotime($staff->birthday));
            // echo $date.'='.date('m-d').', ';
            if ($date == date('m-d')) {
                if ($staff->user->mobile) {
                    $numbers[] = '88'.$staff->user->mobile;
                }
            }
        }
        foreach ($committees as $committee) {
            $date = date('m-d',strtotime($committee->birth_date));
            // echo $date.'='.date('m-d').', ';
            if ($date == date('m-d')) {
                if ($committee->user->mobile) {
                    $numbers[] = '88'.$committee->user->mobile;
                }
            }
        }
        return ["8801729890904"];
        // return $numbers;
    }

    public static function school_name_process($name)
    {
        $school_words=explode(' ',$name);
        foreach ($school_words as $key => $school_word) {
           $school_name_arr[$key]=substr($school_word, 0,6).':';
        }
        return implode(' ', $school_name_arr);
    }





}



?>
