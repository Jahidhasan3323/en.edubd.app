<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class WmSocial extends Model
{
    protected $guarded = array();

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($wm_school) {
            $wm_school->school_id = Auth::getSchool();
        });
    }
}
