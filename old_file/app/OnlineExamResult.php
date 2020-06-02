<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class OnlineExamResult extends Model
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
    protected $guarded = array();
}
