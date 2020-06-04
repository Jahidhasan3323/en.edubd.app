<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    protected $fillable = [
      'school_id', 'provident_fund_rate', 'voucher_title', 'subcategory_view', 'fee_coolection_sms', 'income_sms', 'expense_sms', 'fine_collection_sms', 'absence_fine',
    ];


}
