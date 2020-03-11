<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\Collection\LeaveCollection;

class AttenStudent extends Model
{  

    protected $fillable = [
		'status',
		'student_id',
		'master_class_id',
		'group',
		'section',
		'shift',
		'roll',
		'session',
		'regularity',
		'in_time',
		'out_time',
		'date',
		'school_id',
	 ];

	protected $dates=[
		'date'
	];

	protected $casts = [
	       'date' => 'date',
	];

	public function student()
	{
	    return $this->belongsTo(Student::class,'student_id','student_id');
	}
	public function masterClass()
    {
        return $this->belongsTo(MasterClass::class,'master_class_id','id');
    }

	public function newCollection(array $models = [])
	{
	 return new LeaveCollection($models);
	}

}
