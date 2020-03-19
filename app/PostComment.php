<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostComment extends Model
{
    use SoftDeletes;


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

    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    protected $guarded = array();
}
