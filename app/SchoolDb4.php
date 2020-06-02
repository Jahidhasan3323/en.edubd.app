<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolDb4 extends Model
{

	public function staff()
    {
        return $this->hasMany(StaffDb4::class);
    }

    public function student()
    {
        return $this->hasMany(StudentDb4::class);
    }
    public function user()
    {
        return $this->belongsTo(UserDb4::class);
    }
    protected $guarded = array();
    protected $table = 'schools';
    protected $connection = 'mysql4';
}
