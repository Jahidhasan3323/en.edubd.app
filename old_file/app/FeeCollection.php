<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeCollection extends Model
{
    protected $fillable = [
        'school_id', 'student_id', 'fee_category', 'fund_id', 'serial', 'payment_date', 'payment_method', 'payment_by', 'mobile', 'amount', 'waiver', 'paid', 'due', 'due_paid', 'reference', 'description', 'status',
    ];
    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($fee_cllection) {
            $fee_cllection->due_paid = $fee_cllection->due_paid ?? 0;
        });
    }

    public function student(){
      return $this->belongsTo(Student::class, 'student_id');
    }
    public function category(){
      return $this->belongsTo(FeeCategory::class);
    }
    public function fund(){
      return $this->belongsTo(Fund::class, 'fund_id');
    }


}
