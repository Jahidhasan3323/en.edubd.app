<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Staff extends Model
{
    protected $fillable = [ 
        'user_id', 
        'gender',
        'designation_id', 
        'type',
        'salary', 
        'subject', 
        'edu_qulif', 
        'training', 
        'joining_date', 
        'retirement_date', 
        'index_no', 
        'date_of_mpo', 
        'staff_id',
        'school_id',
        'birthday', 
        'blood_group', 
        'religion', 
        'nid_card_no', 
        'last_org_name', 
        'reason_to_leave', 
        'last_org_address', 
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
        'm_edu_c', 
        'm_mobile_no', 
        'm_email', 
        'm_nid', 
        'h_w_name', 
        'profession', 
        'wedding_date', 
        'h_w_edu_qulif', 
        'h_w_nid_no',
        'h_w_mobile_no', 
        'kids', 
        'photo', 
        'deleted_at', 
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function designation()
    {
    	return $this->belongsTo(Designation::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }

    public function scopeCurrent($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeOld($query)
    {
        return $query->whereNotNull('deleted_at');
    }
    
    public function teacher()
    {
        return $this->belongsTo(User::class,'user_id','id')->where('group_id',3);
    }
     
}
