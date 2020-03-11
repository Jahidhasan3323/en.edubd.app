<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Custom\Attendance\AutoSms;
use App\School;
use App\MessageLength;
use App\ImportantSetting;

class AttendenceSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendence:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Attendence SMS Automatic';

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
        $schools = School::where('sms_service',1)->get();
        $attendance_schools = array();
        $attendance_out_schools = array();
        foreach ($schools as $school) {
            // $attendance_schools[] = $school->id;
            $time = ImportantSetting::where('school_id',$school->id)->first();
            if ($school->attendance_option==1) {
                if ($time) {
                    $time = date('g:i a',strtotime($time->atten_end_time));
                    if (date('g:i a',strtotime('+1 Minutes',strtotime($time))) == date('g:i a')) {
                        $attendance_schools[] = $school->id;
                    }
                }
            }

            if ($school->attendance_option==2) {
                // $attendance_out_schools[] = $school->id;
                $out_time = ImportantSetting::where('school_id',$school->id)->first();
                if ($out_time) {
                    $time = date('g:i a',strtotime($out_time->leave_end_time));
                    if (date('g:i a',strtotime('+1 Minutes',strtotime($time))) == date('g:i a')) {
                        $attendance_out_schools[] = $school->id;
                    }
                }
            }


        }
        if (count($attendance_schools) > 0) {
            $sms_schools = School::whereIn('id', $attendance_schools)->get();
            // Use 1 for employee & 2 for Student
            echo AutoSms::attend($sms_schools,1);
            echo AutoSms::attend($sms_schools,2);
            echo AutoSms::absent($sms_schools,1);
            echo AutoSms::absent($sms_schools,2);
        }
        if (count($attendance_out_schools) > 0) {
            $sms_timeout = School::whereIn('id', $attendance_out_schools)->get();
             // Use 1 for employee & 2 for Student
            // echo AutoSms::attend_out($sms_timeout,1);
            // echo AutoSms::attend_out($sms_timeout,2);
        }

    }
}
