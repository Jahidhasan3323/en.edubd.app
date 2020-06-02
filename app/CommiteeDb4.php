<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommiteeDb4 extends Model
{
	public function user()
	{
	    return $this->belongsTo(UserDb4::class);
	}
    protected $guarded = array();
    protected $table = 'commitees';
    protected $connection = 'mysql4';
}
