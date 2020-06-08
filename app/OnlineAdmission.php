<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class OnlineAdmission extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($admission) {
            $admission->school_id = Auth::getSchool();
            $admission->creator_id = Auth::id();
        });
    }
    
    
    protected $guarded = array();
}
