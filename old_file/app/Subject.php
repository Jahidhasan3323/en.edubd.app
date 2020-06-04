<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Subject extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
    }
    public function groupClass()
    {
        return $this->belongsTo(GroupClass::class);
    }
}
