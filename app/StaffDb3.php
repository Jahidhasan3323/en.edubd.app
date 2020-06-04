<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffDb3 extends Model
{
	public function user()
    {
        return $this->belongsTo(UserDb3::class);
    }
public function school()
    {
        return $this->belongsTo(SchoolDb3::class);
    }
    protected $guarded = array();
    protected $table = 'staff';
    protected $connection = 'mysql3';
}
