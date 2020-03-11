<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CaSubject extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($ca_subject) {
            $ca_subject->school_id = Auth::getSchool();
        });
    }

    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
    }
    public function groupClass()
    {
        return $this->belongsTo(GroupClass::class);
    }
}
