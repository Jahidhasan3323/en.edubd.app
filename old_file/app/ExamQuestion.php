<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
	public function questions()
    {
        return $this->belongsTo(Question::class,'question_id','id')->withTrashed();
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class,'exam_id','id')->withTrashed();
    }
    
    protected $guarded = array();
}
