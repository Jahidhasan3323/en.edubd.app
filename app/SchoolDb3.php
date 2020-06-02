<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolDb3 extends Model
{

	public function staff()
    {
        return $this->hasMany(StaffDb3::class);
    }

    public function student()
    {
        return $this->hasMany(StudentDb3::class);
    }
    public function user()
    {
        return $this->belongsTo(UserDb3::class);
    }
    protected $guarded = array();
    protected $table = 'schools';
    protected $connection = 'mysql3';
}
