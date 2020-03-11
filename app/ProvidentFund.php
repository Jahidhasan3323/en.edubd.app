<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvidentFund extends Model
{
    protected $fillable = [
      'school_id', 'employee_id', 'amount', 'month', 'year', 'status',
    ];

    public function employee(){
      return $this->belongsTo(Staff::class, 'employee_id');
    }


}
