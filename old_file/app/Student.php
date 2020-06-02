<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    protected $fillable = [
                'user_id',
                'gender',
                'master_class_id',
                'shift',
                'section',
                'roll', 
                'session',
                'group',
                'student_id',
                'id_card_exits',
                'regularity',
                'birthday', 
                'blood_group', 
                'religion', 
                'birth_rg_no', 
                'last_sd_org', 
                're_to_lve', 
                'pre_address', 
                'Pre_h_no', 
                'pre_ro_no', 
                'pre_vpm', 
                'pre_poff', 
                'pre_unim', 
                'pre_subd', 
                'pre_district', 
                'pre_postc', 
                'per_address', 
                'per_h_no', 
                'per_ro_no', 
                'per_vpm', 
                'per_poff', 
                'per_unim', 
                'per_subd', 
                'per_district', 
                'per_postc', 
                'father_name', 
                'f_career', 
                'f_m_income', 
                'f_edu_c', 
                'f_mobile_no', 
                'f_email', 
                'f_nid', 
                'mother_name', 
                'm_career', 
                'm_m_income',
                'm_edu_quali',
                'm_mobile_no', 
                'm_email', 
                'm_nid', 
                'local_gar', 
                'career', 
                'relation', 
                'guardian_edu', 
                'guardian_mobile', 
                'guardian_email', 
                'guardian_nid', 
                'school_id',
                'created_by',
                'photo',
                'f_photo',
                'm_photo',
                'deleted_at',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function atten_students()
    {
        return $this->hasMany(AttenStudent::class,'student_id','student_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class,'student_id','student_id');
    }
    
    public function scopeCurrent($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeOld($query)
    {
        return $query->whereNotNull('deleted_at');
    }
}
