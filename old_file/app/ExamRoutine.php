<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamRoutine extends Model
{
    protected $fillable = ['school_id', 'master_class_id','group_class_id', 'exam_type_id', 'name', 'path','status'];

    public function master_class()
    {
        return $this->belongsTo(MasterClass::class);
    }

    public function groupClass()
    {
        return $this->belongsTo(GroupClass::class);
    }

    public function exam_type()
    {
        return $this->belongsTo(ExamType::class);
    }
}
