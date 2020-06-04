<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class MessageLength extends Model
{
	protected $guarded=[];
    use SoftDeletes;

	protected static function boot()
    {
        parent::boot();
        static::creating(function ($message) {
            if (Auth::check()) {
                $message->notification = $message->notification??'0';
            }
        });
    }
	public function school(){
		return $this->belongsTo(School::class);
	}



}
