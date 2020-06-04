<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterClassDb2 extends Model
{
    protected $guarded = array();
    protected $table = 'master_classes';
    protected $connection = 'mysql2';
}
