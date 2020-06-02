<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
      'serial', 'school_id', 'asset_name', 'qty', 'unit_price', 'total_price', 'desription', 'start_date', 'end_date', 'asset_valuation_increase', 'asset_valuation_decrease', 'status',
    ];

    protected $table = 'assets';
}
