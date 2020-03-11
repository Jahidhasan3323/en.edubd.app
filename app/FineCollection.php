<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FineCollection extends Model
{
    protected $fillable = [
      'school_id', 'student_id', 'fund_id', 'serial', 'payment_date', 'payment_method', 'payment_by', 'mobile', 'amount', 'paid', 'waiver', 'due', 'reference', 'description', 'status',
    ];

    public function student(){
      return $this->belongsTo(Student::class, 'student_id');
    }

    public function fund(){
      return $this->belongsTo(Fund::class, 'fund_id');
    }

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($fine_cllection) {
            $fine_cllection->waiver = $fine_cllection->waiver ?? 0;
        });
    }


}
