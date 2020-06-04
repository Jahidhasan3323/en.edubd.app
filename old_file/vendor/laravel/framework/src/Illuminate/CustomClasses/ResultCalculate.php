<?php

namespace Illuminate\CustomClasses;
use Illuminate\Support\Facades\Facade;



class ResultCalculate extends Facade
{
    public static function calculateResult($marks, $fullMarks)
    {
        $gpaPoint = [];

        if ($marks > (79 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 5, 'grade' => 'A+');
        } elseif ($marks < (80 / 100) * $fullMarks && $marks > (69 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 4, 'grade' => 'A');

        } elseif ($marks < (70 / 100) * $fullMarks && $marks > (59 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 3.5, 'grade' => 'A-');

        } elseif ($marks < (60 / 100) * $fullMarks && $marks > (49 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 3, 'grade' => 'B');

        } elseif ($marks < (50 / 100) * $fullMarks && $marks > (39 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 2, 'grade' => 'C');

        } elseif ($marks < (40 / 100) * $fullMarks && $marks > (32 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 1, 'grade' => 'D');

        }else if($marks < (33 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 0, 'grade' => 'F');
        }

        return $gpaPoint;
    }

    public static function average($results)
    {
        $fGradeCount = 0;
        $average = 0;
        $optionalSubName = '';
        $optionalSubMarks = 0;

        $totalPoint = 0;
        foreach ($results as $result){
            if ($result->status == 'Optional' && !(self::calculateResult($result->marks, $result->full_marks)['grade'] == 'F')){
                $optionalSubMarks = $result->marks;
                $optionalSubName = $result->name;
                continue;
            }

            $totalPoint += self::calculateResult($result->marks, $result->full_marks)['gpa'];
            if (self::calculateResult($result->marks, $result->full_marks)['grade'] == 'F'){
                $average =  array('gpa' => '...', 'grade' => 'F');
                return $average;
            }
        }

        if (!$optionalSubMarks){
            $averageGpa = $totalPoint / $results->count();
            if ($averageGpa > 5){
                $averageGpa = 5.00;
            }
        }else{
            $totalPoint += self::calculateResult($optionalSubMarks, $result->full_marks)['gpa'] - 2;
            $averageGpa = $totalPoint / ($results->count() - 1);
            if ($averageGpa > 5){
                $averageGpa = 5.00;
            }
        } 

        $grade = '';
        if ($averageGpa == 5){
            $grade = 'A+';
        } elseif ($averageGpa < 5 && $averageGpa >= 4){
            $grade = 'A';
        } elseif ($averageGpa < 4 && $averageGpa >= 3.5){
            $grade = 'A-';
        } elseif ($averageGpa < 3.5 && $averageGpa >= 3){
            $grade = 'B';
        } elseif ($averageGpa < 3 && $averageGpa > 2){
            $grade = 'C';
        } elseif ($averageGpa < 2 && $averageGpa > 1){
            $grade = 'D';
        }else{
            $grade = 'F';
        }

        $average =  array('gpa' => number_format($averageGpa, 2), 'grade' => $grade);
        return $average;
    }
}
