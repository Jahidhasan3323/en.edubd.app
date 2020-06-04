<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterClassDb3 extends Model
{
    protected $guarded = array();
    protected $table = 'master_classes';
    protected $connection = 'mysql3';
}
