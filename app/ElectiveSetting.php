<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class ElectiveSetting extends Model
{
    protected $guarded=[];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($electiveSetting) {
            $electiveSetting->school_id = Auth::getSchool();
        });
    }

    public function master_class(){
      return $this->belongsTo(MasterClass::class); 
    }
    public function group_class(){
      return $this->belongsTo(GroupClass::class);
    }
}
