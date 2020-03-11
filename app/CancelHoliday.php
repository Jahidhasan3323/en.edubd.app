<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelHoliday extends Model
{
    protected $guarded=[];

    protected $dates=[
    	'date'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
