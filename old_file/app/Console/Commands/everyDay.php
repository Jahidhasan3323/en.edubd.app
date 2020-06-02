<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Holiday;
use App\School;
use App\Student;
use App\AttenStudent;
use App\Staff;
use App\AttenEmployee;
use App\ImportantSetting;
use Illuminate\Support\Facades\DB;

class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyday:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This check all attendance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schools = School::pluck('id');
        foreach($schools as $key => $school_id) {
            $time = ImportantSetting::where('school_id',$school_id)->first();
            $time = $time?date('g:i a', strtotime($time->atten_end_time)):date('g:i a',strtotime('10:10 am'));
            if ($time==date('g:i a')) {
                $day = Holiday::whereIn('school_id',[$school_id,0])->whereDate('date',date('Y-m-d'))->first();
                $this->student_attendance($day,$school_id);
                $this->employee_attendance($day,$school_id);
            }

        }
        echo 'success';
    }

    public function student_attendance($day,$school_id){
        $attend_students = AttenStudent::where('school_id',$school_id)->whereDate('date', date('Y-m-d'))->pluck('student_id');
        $students = Student::where('school_id',$school_id)->whereNotIn('id',$attend_students)->current()->get();
        foreach ($students as $key => $student) {
            $data=[
                'status'=>'A',
                'student_id'=>$student->student_id,
                'master_class_id'=>$student->master_class_id,
                'group'=>$student->group,
                'section'=>$student->section,
                'shift'=>$student->shift,
                'roll'=>($student->roll==NULL)?'00':$student->roll,
                'session'=>$student->session,
                'regularity'=>$student->regularity,
                'date'=>date('Y-m-d'),
                'school_id'=>$student->school_id
            ];
            if($day){
                $data['status']='H';
            }
            dd($data);
            AttenStudent::create($data);
        }
    }
    public function employee_attendance($day,$school_id){
        $attend_employees = AttenEmployee::where('school_id',$school_id)->whereDate('date', date('Y-m-d'))->pluck('staff_id');
        $employees = Staff::where('school_id',$school_id)->current()->get();
        foreach ($employees as $key => $employee) {
            $data=[
                'status'=>'A',
                'staff_id'=>$employee->staff_id,
                'date'=>date('Y-m-d'),
                'school_id'=>$employee->school_id
            ];
            if($day){
                $data['status']='H';
            }
            AttenEmployee::create($data);
        }
    }
}
