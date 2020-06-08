<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class OnlineAdmissionApplicationSubject extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($admission) {
           // $admission->school_id = Auth::getSchool();
        });
    }
    
    
    protected $fillable = ['name','type','status','o_a_application_id','school_id'];
}
