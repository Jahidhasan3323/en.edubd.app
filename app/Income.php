<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'school_id', 'serial', 'payment_date', 'payment_method', 'payment_by', 'mobile', 'amount', 'fund_id', 'reference', 'description', 'status',
    ];

    public function fund(){
      return $this->belongsTo(Fund::class, 'fund_id');
    }


}
