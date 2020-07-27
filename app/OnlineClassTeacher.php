<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OnlineClassTeacher extends Model
{
    use SoftDeletes;

    public function online_class_us()
    {
        return $this->belongsTo(OnlineClassUs::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

    protected $guarded = array();
}
