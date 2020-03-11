<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class WmImportantLinksCategory extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function($wm_link) {
            $wm_link->school_id = Auth::getSchool();
        });
    }

    public function important_links()
    {
        return $this->hasMany(WmImportantLink::class);
    }
    
    protected $guarded = array();
}
