<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class WmSpeech extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($wm_slider) {
            $wm_slider->school_id = Auth::getSchool();
        });
    }
    public function speech_type()
    {
        return $this->belongsTo(WmSpeechType::class,'type_id','id');
    }
    protected $guarded = array();
}
