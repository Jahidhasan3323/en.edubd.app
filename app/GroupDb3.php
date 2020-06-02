<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupDb3 extends Model
{
	public function users()
    {
        return $this->hasMany(UserDb3::class);
    }
    protected $guarded = array();
    protected $table = 'groups';
    protected $connection = 'mysql3';
}
