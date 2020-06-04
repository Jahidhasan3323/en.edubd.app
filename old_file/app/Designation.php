<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = ['name','type'];

    public function teachers()
    {
    	return $this->hasMany(Teacher::class);
    }

    public function committee()
    {
    	return $this->hasMany(Commitee::class);
    }
}
