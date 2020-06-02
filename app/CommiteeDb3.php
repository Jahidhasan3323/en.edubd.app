<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommiteeDb3 extends Model
{
	public function user()
	{
	    return $this->belongsTo(UserDb3::class);
	}
    protected $guarded = array();
    protected $table = 'commitees';
    protected $connection = 'mysql3';
}
