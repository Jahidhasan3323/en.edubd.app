<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostReact extends Model
{
    use SoftDeletes;
     
    /*public function user()
    {
        return $this->belongsTo(User::class);
    }*/
    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id','id');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    
    protected $guarded = array();
}
