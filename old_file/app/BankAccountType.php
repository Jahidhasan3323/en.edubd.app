<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccountType extends Model
{
    protected $fillable = ['school_id', 'name', 'status'];
    protected $table = 'bank_account_types';
}
