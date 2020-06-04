<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class School extends Model
{
    protected $fillable = [
         'user_id',
         'short_name',
         'address',
         'api_key',
         'sender_id',
         'school_type_id',
         'website',
         'fax',
         'code',
         'established_date',
         'expiry_date',
         'logo',
         'status',
         'total_student',
         'country_code',
         'serial_no',
         'signature_p',
         'service_type_id',
         'sms_service',
         'attendance_sms',
         'attend_percentage_limit',
    ];



    public function atten_employees()
    {
        return $this->hasMany(AttenEmployee::class);
    }

    public function atten_students()
    {
        return $this->hasMany(AttenStudent::class);
    }

    public function absent_content()
    {
        return $this->hasOne(AbsentContent::class);
    }


    public function commitees()
    {
        return $this->hasMany(Commitee::class);
    }


    public function class_routines()
    {
        return $this->hasMany(ClassRoutine::class);
    }

    public function exam_routines()
    {
        return $this->hasMany(ExamRoutine::class);
    }



    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }


    public function notices()
    {
        return $this->hasMany(Notice::class);
    }


    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function subject_teachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function units()
    {
        return $this->hasMany(Unit::class);
    }


    public function important_setting()
    {
        return $this->hasOne(ImportantSetting::class);
    }
    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
    }

}
