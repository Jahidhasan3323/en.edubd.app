<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterClass extends Model
{
    protected $fillable = ['name','school_type_id'];
    
    public function schoolType()
    {
        return $this->belongsTo(SchoolType::class);
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
