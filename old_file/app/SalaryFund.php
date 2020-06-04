<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryFund extends Model
{
    protected $fillable = [
      'school_id', 'name', 'amount', 'status',
    ];
}
