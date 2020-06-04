<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffDb4 extends Model
{
	public function user()
    {
        return $this->belongsTo(UserDb4::class);
    }
public function school()
    {
        return $this->belongsTo(SchoolDb4::class);
    }
    protected $guarded = array();
    protected $table = 'staff';
    protected $connection = 'mysql4';
}
