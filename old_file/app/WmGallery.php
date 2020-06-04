<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class WmGallery extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($wm_slider) {
            $wm_slider->school_id = Auth::getSchool();
        });
    }
    public function gallery_category()
    {
        return $this->belongsTo(WmGalleryCategory::class,'wm_gallery_category_id','id');
    }
    protected $guarded = array();
}
