<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommiteeDb2 extends Model
{
	public function user()
	{
	    return $this->belongsTo(UserDb2::class);
	}
    protected $guarded = array();
    protected $table = 'commitees';
    protected $connection = 'mysql2';
}
