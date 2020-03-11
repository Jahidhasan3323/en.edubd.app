<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class AttendanceText extends Model
{
	protected $guarded=[];
    use SoftDeletes;

	// protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($attendance_text) {
    //         if (Auth::check()) {
    //             $attendance_text->school_id = Auth::getSchool();
    //         }
    //     });
    // }

	public function school(){
		return $this->belongsTo(School::class);
	}
}
