<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanksWithdraw extends Model
{
    protected $fillable = [
      'serial', 'school_id', 'bank_id', 'account_type_id', 'account_number', 'check_number', 'amount', 'withdraw_by', 'purpose', 'description', 'withdra_date', 'status',
    ];

    public function bank(){
      return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function account_type(){
      return $this->belongsTo(BankAccountType::class, 'account_type_id');
    }
}
