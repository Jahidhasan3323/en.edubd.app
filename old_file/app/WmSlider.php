<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class WmSlider extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($wm_slider) {
            $wm_slider->school_id = Auth::getSchool();
        });
    }
    protected $guarded = array();
}
