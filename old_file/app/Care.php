<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Care extends Model
{
	protected $guarded=[];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($care) {
            if (Auth::check()) {
                $care->school_id = Auth::getSchool();
            }
        });
    }

	public function school(){
		return $this->belongsTo(School::class);
	}

}
