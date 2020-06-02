<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDb3 extends Model
{

	public function school()
    {
        return $this->hasOne(SchoolDb3::class,'user_id', 'id');
    }
    public function student()
    {
        return $this->hasOne(StudentDb3::class,'user_id','id');
    }
    public function staff()
    {
        return $this->hasOne(StaffDb3::class,'user_id','id');
    }
    public function committee()
    {
        return $this->hasOne(CommiteeDb3::class,'user_id','id');
    }

    public function group()
    {
        return $this->belongsTo(GroupDb3::class);
    }
	protected $guarded = array();
    protected $table = 'users';
    protected $connection = 'mysql3';
}
