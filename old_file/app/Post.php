<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Post extends Model
{
	use SoftDeletes;
     protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->school_id = Auth::getSchool() ?? 0;
            $post->user_id = Auth::id();
            $post->db = 1;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function user2()
    {
        return $this->belongsTo(UserDb2::class,'user_id','id');
    }
    public function user3()
    {
        return $this->belongsTo(UserDb3::class,'user_id','id');
    }
    public function user4()
    {
        return $this->belongsTo(UserDb4::class,'user_id','id');
    }
    public function likes()
    {
        return $this->hasMany(PostReact::class)->where(['status'=>1,'react'=>1]);
    }
    public function loves()
    {
        return $this->hasMany(PostReact::class)->where(['status'=>1,'react'=>2]);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function school2()
    {
        return $this->belongsTo(SchoolDb2::class,'school_id','id');
    }
    public function school3()
    {
        return $this->belongsTo(SchoolDb3::class,'school_id','id');
    }
    public function school4()
    {
        return $this->belongsTo(SchoolDb4::class,'school_id','id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class)->where(['status'=>1]);
    }
    protected $guarded = array();
}
