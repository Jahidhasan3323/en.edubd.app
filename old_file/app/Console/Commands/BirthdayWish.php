<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Custom\BirthdayNumber;
use App\Http\Controllers\Controller;
use App\BirthdayText;
use App\MessageLength;
use App\School;
use App\Student;
use App\Staff;
use App\Commitee;
use App\Custom\Sms;
use Auth;

class BirthdayWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:wish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday with by sms';

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
        $school_id = MessageLength::where('birthday_sms',1)->select('school_id')->get();
        $schools = School::whereIn('id',$school_id)->get();
        foreach ($schools as $school) {
            $students = Student::where('school_id', $school->id)->current()->get();
            $staffs = Staff::where('school_id', $school->id)->current()->get();
            $committees = Commitee::where('school_id', $school->id)->current()->get();
            $school_name = $school->short_name?? BirthdayNumber::school_name_process($school->user->name);
            $message = BirthdayText::where('school_id', $school->id)->first();
			$message = urlencode($message?$message->content.' '.$school_name:'শুভ জন্মদিন '.$school_name);
            $all_numbers = BirthdayNumber::get_numbers($students,$staffs,$committees);
            $chunks = array_chunk($all_numbers,100);
            foreach ($chunks as $chunk) {
                $numbers = implode(',',$chunk);
                $url = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$numbers."&message=".$message;
    			Sms::send($url);
            }

        }

    }

}
