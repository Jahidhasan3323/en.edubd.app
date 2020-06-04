<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupDb4 extends Model
{
	public function users()
    {
        return $this->hasMany(UserDb4::class);
    }
    protected $guarded = array();
    protected $table = 'groups';
    protected $connection = 'mysql4';
}
