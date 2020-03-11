<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Result extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id','student_id');
    }
    public function master_class()
    {
        return $this->belongsTo(MasterClass::class);
    }
    public function group_class()
    {
        return $this->belongsTo(GroupClass::class);
    }

    public function exam_type()
    {
        return $this->belongsTo(ExamType::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($result) {
            $result->author_by = Auth::user()->id;
            $result->school_id = Auth::getSchool();
        });
    }
    

}
