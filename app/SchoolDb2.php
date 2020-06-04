<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolDb2 extends Model
{

	public function staff()
    {
        return $this->hasMany(StaffDb2::class);
    }

    public function student()
    {
        return $this->hasMany(StudentDb2::class);
    }
    public function user()
    {
        return $this->belongsTo(UserDb2::class);
    }
    protected $guarded = array();
    protected $table = 'schools';
    protected $connection = 'mysql2';
}
