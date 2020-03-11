<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalarySheet extends Model
{
    protected $fillable = [
      'school_id', 'employee_id', 'basic', 'basic_increase', 'basic_decrease', 'provident_fund', 'absent_fine', 'advanced_paid', 'net_salary', 'month', 'year', 'status',
    ];

    public function employee(){
      return $this->belongsTo(Staff::class, 'employee_id');
    }
    public function designation(){
      return $this->belongsTo(Designation::class, 'designation_id');
    }

}
