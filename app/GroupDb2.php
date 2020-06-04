<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupDb2 extends Model
{
	public function users()
    {
        return $this->hasMany(UserDb2::class);
    }
    protected $guarded = array();
    protected $table = 'groups';
    protected $connection = 'mysql2';
}
