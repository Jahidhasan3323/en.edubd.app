<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commitee extends Model
{
    protected $fillable = [
    	'user_id', 'gender', 'designation_id', 'edu_quali', 'join_date', 'retire_date', 'birth_date', 'blood', 'religion', 'nid', 'home_name', 'holding_name', 'road_name', 'village', 'post_office', 'unione', 'thana', 'district', 'post_code', 'regine', 'school_id', 'image','deleted_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCurrent($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeOld($query)
    {
        return $query->whereNotNull('deleted_at');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }


}
