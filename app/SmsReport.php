<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class SmsReport extends Model
{
	protected $guarded=[];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($sms_report) {
            if (Auth::check()) {
                $sms_report->school_id = Auth::getSchool();
            }
        });
    }

	public function school(){
		return $this->belongsTo(School::class);
	}


}
