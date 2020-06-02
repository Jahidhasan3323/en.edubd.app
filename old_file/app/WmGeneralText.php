<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class WmGeneralText extends Model
{
     protected static function boot()
    {
        parent::boot();
        static::creating(function ($wm_slider) {
            $wm_slider->school_id = Auth::getSchool();
        });
    }
    public function general_text_type()
    {
        return $this->belongsTo(WmGeneralTextType::class,'wm_general_text_type_id','id');
    }
    protected $guarded = array();
}
