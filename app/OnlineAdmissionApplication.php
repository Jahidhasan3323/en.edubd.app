<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class OnlineAdmissionApplication extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($admission) {
            //$admission->school_id = 6;
        });
    }
    
    public function studentSubject()
        {
            return $this->belongsTo(OnlineAdmissionApplicationSubject::class);
        }
    
    protected $fillable = ['name_bn','name_en','father_name_bn','father_name_en','mother_name_bn','mother_name_en','birth_certificate_no','dob','parents_income','parents_phone','phone','email','religion','nationality','parmanent_vill','parmanent_post','parmanent_upozila','parmanent_zila','present_vill','present_post','present_upozila','present_zila','picture','signature','class','reg_no','password','status','type','online_admission_id','school_id'];
}
