<?php

namespace App\Http\Controllers;

use App\ExamType;
use App\School;
use App\SchoolExam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SchoolExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::is('admin')){
            return view('backEnd.admin.dashboard');
        }

        $school = $this->get_school();
        $exams =ExamType::all();
        return view('backEnd.exam.schoolExamInfo', compact('school', 'exams'));
    }

    public function get_school(){
        $school = School::where('user_id', Auth::user()->id)
        ->join('users', 'schools.user_id', '=', 'users.id')->select('schools.id','users.name')->first();
        return $school;
    }
}
