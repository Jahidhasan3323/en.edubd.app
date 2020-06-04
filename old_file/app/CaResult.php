<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CaResult extends Model
{
    protected $guarded=[];
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($ca_result) {
            $ca_result->school_id = Auth::getSchool();
            $ca_result->author_by = Auth::user()->id;
            $gpa=Auth::calculateResult($ca_result->marks,$ca_result->total_mark)['gpa'];
            $ca_result->gpa = $gpa;
            $grade = Auth::grade(Auth::calculateResult($ca_result->marks,$ca_result->total_mark)['gpa']);
            $ca_result->grade_latter = strtoupper($grade);
        });
    }
}
