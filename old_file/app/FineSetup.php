<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FineSetup extends Model
{
    protected $table = "fine_setups";
    protected $fillable = [
      'school_id', 'master_class_id', 'group_class_id', 'shift', 'amount', 'status',
    ];

    public function fee_category(){
      return $this->belongsTo(FeeCategory::class, 'fee_category_id');
    }
    public function group_class(){
      return $this->belongsTo(GroupClass::class, 'group_class_id');
    }
    public function master_class(){
      return $this->belongsTo(MasterClass::class, 'master_class_id');
    }

    
}
