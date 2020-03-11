<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ImportantSetting extends Model
{
    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($important_setting) {
            $important_setting->school_id = Auth::getSchool();
        });
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
