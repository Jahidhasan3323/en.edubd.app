<?php
namespace App\Custom;

use Illuminate\Http\Request;
use Auth;

class AllNumber{
    public static function get_numbers($students,$staffs,$committees){
        $numbers = array();
        foreach ($students as $student) {
            if ($student->f_mobile_no) {
                $numbers[] = '88'.$student->f_mobile_no;
            }elseif ($student->m_mobile_no) {
                $numbers[] = '88'.$student->m_mobile_no;
            }elseif($student->user->mobile) {
                $numbers[] = '88'.$student->user->mobile;
            }

        }
        foreach ($staffs as $staff) {
            if ($staff->user->mobile) {
                $numbers[] = '88'.$staff->user->mobile;
            }
        }
        foreach ($committees as $committee) {
            if ($committee->user->mobile) {
                $numbers[] = '88'.$committee->user->mobile;
            }
        }
        return implode(',',$numbers);
    }





}



?>
