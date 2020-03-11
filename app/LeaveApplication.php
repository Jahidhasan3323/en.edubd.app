<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class LeaveApplication extends Model
{
	protected $casts = [
    'form_date' => 'date',
    'to_date' => 'date',
];
    
    public function staff()
        {
            return $this->belongsTo(Staff::class,'user_id','user_id');
        }
    public function school()
        {
            return $this->belongsTo(School::class);
        }
    public function student()
        {
            return $this->belongsTo(Student::class,'user_id','user_id');
        }
    protected static function boot()
        {
            parent::boot();
            static::creating(function ($leave_application) {
                $leave_application->school_id = Auth::getSchool();
                $leave_application->user_id = Auth::id();
                $leave_application->status = 0;
            });
        }


       




    protected $guarded = array();
}
