<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
   
    public function online_class_teacher()
    {
        return $this->hasMany(OnlineClassTeacher::class);
    }
    
    public function online_class_teacher1()
    {
        return $this->hasMany(OnlineClassTeacher::class,'online_class_us_id','id')->where('teacher_id',Auth::id());
    }
    

    protected $guarded = array();
}
