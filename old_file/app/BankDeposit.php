<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDeposit extends Model
{
    protected $fillable = [
      'serial', 'school_id', 'bank_id', 'account_type_id', 'account_number', 'deposit_number', 'amount', 'deposit_by', 'purpose', 'description', 'deposit_date', 'status',
    ];

    public function bank(){
      return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function account_type(){
      return $this->belongsTo(BankAccountType::class, 'account_type_id');
    }

}
