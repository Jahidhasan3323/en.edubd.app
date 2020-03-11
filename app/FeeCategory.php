<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\FeeSubCategory;
use Auth;

class FeeCategory extends Model
{
    protected $fillable = [
        'name', 'status',
    ];

    public function fee_sub_category(){
      return $this->hasMany(FeeSubCategory::class, 'fee_category_id')->where('school_id', Auth::getSchool());
    }

    public function sub_categories($fee_category_id, $master_class_id, $group_id){
      return FeeSubCategory::where('school_id', Auth::getSchool())
                            ->where('master_class_id', $master_class_id)
                            ->where('fee_category_id', $fee_category_id)
                            ->where('group_class_id', $group_id)
                            ->get();
    }

}
