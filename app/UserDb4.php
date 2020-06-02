<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDb4 extends Model
{

	public function school()
    {
        return $this->hasOne(SchoolDb4::class,'user_id', 'id');
    }
    public function student()
    {
        return $this->hasOne(StudentDb4::class,'user_id','id');
    }
    public function staff()
    {
        return $this->hasOne(StaffDb4::class,'user_id','id');
    }
    public function committee()
    {
        return $this->hasOne(CommiteeDb4::class,'user_id','id');
    }

    public function group()
    {
        return $this->belongsTo(GroupDb4::class);
    }
	protected $guarded = array();
    protected $table = 'users';
    protected $connection = 'mysql4';
}
