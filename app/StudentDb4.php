<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDb4 extends Model
{
	public function masterClass()
    {
        return $this->belongsTo(MasterClassDb4::class,'master_class_id','id');
    }

    public function school()
    {
        return $this->belongsTo(SchoolDb4::class,'school_id','id');
    }
    protected $guarded = array();
    protected $table = 'students';
    protected $connection = 'mysql4';
}
