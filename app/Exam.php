<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Exam extends Model
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
    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
    }
    public function group_class()
    {
        return $this->belongsTo(GroupClass::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    protected $guarded = array();
}
