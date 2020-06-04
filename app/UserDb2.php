<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class UserDb2 extends Model
{

	public function school()
    {
        return $this->hasOne(SchoolDb2::class,'user_id', 'id');
    }
    public function student()
    {
        return $this->hasOne(StudentDb2::class,'user_id','id');
    }
    public function staff()
    {
        return $this->hasOne(StaffDb2::class,'user_id','id');
    }
    public function committee()
    {
        return $this->hasOne(CommiteeDb2::class,'user_id','id');
    }

    public function group()
    {
        return $this->belongsTo(GroupDb2::class);
    }
	protected $guarded = array();
    protected $table = 'users';
    protected $connection = 'mysql2';
}
