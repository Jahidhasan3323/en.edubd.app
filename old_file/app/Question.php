<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Question extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($question) {
            $question->school_id = Auth::getSchool();
            $question->user_id = Auth::id();
        });
    }
    public function options()
    {
        return $this->hasMany(QuestionOption::class,'question_id','id');
    }
    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
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
