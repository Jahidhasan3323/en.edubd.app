<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalarySetup extends Model
{
    protected $fillable = [
      'school_id', 'employee_id', 'amount', 'status',
    ];

    public function employee(){
      return $this->belongsTo(Staff::class, 'employee_id');
    }
}
