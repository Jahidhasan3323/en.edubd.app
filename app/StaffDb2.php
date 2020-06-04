<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffDb2 extends Model
{
	public function user()
    {
        return $this->belongsTo(UserDb2::class);
    }
public function school()
    {
        return $this->belongsTo(SchoolDb2::class);
    }
    protected $guarded = array();
    protected $table = 'staff';
    protected $connection = 'mysql2';
}
