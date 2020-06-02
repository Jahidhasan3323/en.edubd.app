<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class OnlineWrittenExamAnswer extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($question) {
            $question->school_id = Auth::getSchool();
            $question->user_id = Auth::id();
        });
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class)->withTrashed();
    }
    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
    }
    protected $guarded = array();
}
