<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancedPaid extends Model
{
    protected $fillable = [
      'school_id', 'employee_id', 'amount', 'description', 'month', 'year', 'payment_date', 'status',
    ];

    public function employee(){
      return $this->belongsTo(Staff::class, 'employee_id');
    }


}
