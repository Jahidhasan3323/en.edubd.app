<?php

namespace App\Http\Controllers;

use App\ExamType;
use App\MasterClass;
use App\School;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MakePdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function result()
    {
        if (!Session::has('student')){
            return redirect('/results');
        }
        $exam = ExamType::find(Session::get('exam'));
        $class = MasterClass::find(Session::get('class'));
        $year = Session::get('year');
        $student_id = Session::get('student');
        $results = DB::table('results')
            ->join('subjects', 'results.subject_id', '=', 'subjects.id')
            ->where([
                ['results.student_id', $student_id],
                ['results.session', $year],
                ['results.master_class_id', Session::get('class')],
                ['results.exam_type_id', Session::get('exam')],
                ['results.school_id', Auth::getSchool()],
                ['results.status', 1],
            ])
            ->select(array(
                'results.id',
                'results.student_id',
                'results.subject_id',
                'results.marks',
                'results.added_by',
                'subjects.code',
                'subjects.name',
                'subjects.full_marks',
                'subjects.pass as passMark',
                'subjects.status'
            ))
            ->orderBy('subjects.code')
            ->get();
        $student = DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->join('student_classes', 'students.id', '=', 'student_classes.student_id')
            ->join('units', 'student_classes.unit_id', '=', 'units.id')
            ->join('master_classes', 'student_classes.master_class_id', 'master_classes.id')
            ->select(array(
                'users.name',
                'student_classes.roll',
                'master_classes.name as class',
                'units.name as unit',
                'students.father_name',
                'students.mother_name',
                'students.birthday',
            ))
            ->where([
                ['students.student_id', $student_id],
                ['students.school_id', Auth::getSchool()]
            ])
            ->first();
        //dd($results);
        if ($results->count()){
            $passResult = 1;
            $failedCount = 0;
            foreach ($results as $result){
                if (\Illuminate\CustomClasses\ResultCalculate::calculateResult($result->marks, $result->full_marks)['grade'] == 'F'){
                    $failedCount = 1;
                    break;
                }
            }
            if ($failedCount){
                $passResult = 0;
            }

            $schoolName = DB::table('students')
                ->join('schools', 'students.school_id', '=', 'schools.id')
                ->join('users', 'schools.user_id', '=', 'users.id')
                ->select(array('users.name', 'schools.logo'))
                ->where('students.student_id', $student_id)
                ->first();

            
            $html=view('backEnd.results.pdf_result',compact('schoolName','student','class','exam','year','passResult','results'));

            $pdf=PDF::loadHtml($html);
            return $pdf->stream('result.pdf');
        }
    }
}

