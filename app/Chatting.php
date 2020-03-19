<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Chatting extends Model
{
    use SoftDeletes;
     protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->from = Auth::id();
        });
    }

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'from','id');
    }
    public function user2()
    {
        return $this->belongsTo(UserDb2::class,'from','id');
    }
    public function user3()
    {
        return $this->belongsTo(UserDb3::class,'from','id');
    }
    public function user4()
    {
        return $this->belongsTo(UserDb4::class,'from','id');
    }
    public function to_user()
    {
        return $this->belongsTo(User::class,'to','id');
    }
    public function to_user2()
    {
        return $this->belongsTo(UserDb2::class,'to','id');
    }
    public function to_user3()
    {
        return $this->belongsTo(UserDb3::class,'to','id');
    }
    public function to_user4()
    {
        return $this->belongsTo(UserDb4::class,'to','id');
    }
   
    
    protected $guarded = array();
}
