<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class WmImportantLinksRoot extends Model
{
    
    public function important_links_category_root()
    {
        return $this->belongsTo(WmImportantLinksCategoryRoot::class,'wm_important_links_category_root_id','id');
    }
    
    protected $guarded = array();
}
