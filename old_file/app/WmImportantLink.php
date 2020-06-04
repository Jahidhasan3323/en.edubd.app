<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class WmImportantLink extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($wm_important_link) {
            $wm_important_link->school_id = Auth::getSchool();
        });
    }
    public function important_links_category()
    {
        return $this->belongsTo(WmImportantLinksCategory::class,'wm_important_links_category_id','id');
    }
    protected $guarded = array();
}
