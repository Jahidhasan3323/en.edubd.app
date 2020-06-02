<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\School;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password', 'group_id','deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function school()
    {
        return $this->hasOne(School::class);
    }
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
