<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Complaint extends Model
{
	protected $guarded=[];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($complain) {
            $complain->school_id = Auth::getSchool();
        });
    }

}
