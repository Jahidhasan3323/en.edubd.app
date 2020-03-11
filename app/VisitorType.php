<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class VisitorType extends Model
{
	protected $guarded=[];
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($visitor_type) {
            $visitor_type->school_id = Auth::getSchool();
        });
    }

	public function school(){
		return $this->belongsTo(School::class);
	}


}
