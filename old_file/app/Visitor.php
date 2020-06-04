<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Visitor extends Model
{
	protected $guarded=[];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($visitor) {
            $visitor->school_id = Auth::getSchool();
        });
    }

	public function visitor_type(){
		return $this->belongsTo(VisitorType::class);
	}

	public function school(){
		return $this->belongsTo(School::class);
	}


}
