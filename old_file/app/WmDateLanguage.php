<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WmDateLanguage extends Model
{
	use SoftDeletes;




	public function date_language()
    {
        return $this->belongsTo(DateLanguage::class);
    }
    protected $guarded = array();
    
}
