<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineClassUs extends Model
{
    use SoftDeletes;
    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
    }
    
    public function school()
    {
        return $this->belongsTo(School::class);
    }
   
    public function user()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }
    

    protected $guarded = array();
}
