<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable=['date','school_id'];

    protected $dates=[
    	'date'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
