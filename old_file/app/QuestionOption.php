<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    protected $guarded = array();
}
