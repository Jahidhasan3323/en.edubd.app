<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Collection\EmployeeLeaveCollection;

class AttenEmployee extends Model
{
    protected $fillable = [
    	    'status',
			'school_id',
			'staff_id',
			'date',
			'in_time',
			'out_time',
			'year',
	];

	protected $dates=[
		'date'
	];

	protected $casts = [
	       'date' => 'date',
	];

	public function staff()
	{
	    return $this->belongsTo(Staff::class,'staff_id','staff_id');
	}

	public function newCollection(array $models = [])
	{
	 return new EmployeeLeaveCollection($models);
	}
}
