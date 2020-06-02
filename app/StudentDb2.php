<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDb2 extends Model
{
	public function masterClass()
    {
        return $this->belongsTo(MasterClassDb2::class,'master_class_id','id');
    }

    public function school()
    {
        return $this->belongsTo(SchoolDb2::class,'school_id','id');
    }
    protected $guarded = array();
    protected $table = 'students';
    protected $connection = 'mysql2';
}
