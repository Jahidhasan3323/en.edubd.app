<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class TransferCertificate extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($testimonial) {
            $testimonial->school_id = Auth::getSchool();
        });
    }
    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id','student_id');
    }
    protected $guarded = array();
}
