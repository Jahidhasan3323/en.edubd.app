<?php
/**
 * Created by PhpStorm.
 * User: Mehedi
 * Date: 20-May-17
 * Time: 10:34 AM
 */

namespace Illuminate\CustomClasses;
use App\School;
use App\Staff;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\CustomClasses\Input;

class Get extends Facade
{
    protected static $expiry = null;

    public static function user($user_id = null)
    {
        return User::find($user_id);
    }

    public static function serial($data){
        //$sl = null;
        if (Input::get('page') >= 2){
            $sl = $data->perPage() * Input::get('page') - Input::get('page');
            if ($data->count() == 1){
                $sl = $data->perPage() * (Input::get('page') - 1) + 1;
            }else{
                $sl = $data->perPage() * Input::get('page') - Input::get('page') + 1;
            }
        }else{
            $sl = 1;
        }
        return $sl;
    }

    public static function expiry()
    {
        $school_id = Auth::getSchool();
       $school_data = School::where('id',$school_id)->first();
        
        $expiry = date_create($school_data->expiry_date);
        $today = date_create(date('d-m-Y'));
        $interval = date_diff($today, $expiry);

        if ($interval->format('%R%a') < 0){
            $status = 0;
            $school_data->status = $status;
            $school_data->update();
        }

        if ($interval->format('%R%a') >= 0){
            $status = 1;
            $school_data->status = $status;
            $school_data->update();
        }
        self::$expiry = $interval->format('%a');

        return $interval->format('%R%a');
    }

    public static function expiryDays()
    {
        if (self::$expiry){
            return 'Your account will be expired within '. self::$expiry . ' days. Please contact to your provider.';
        }
        return 'Your account will expire today. Please contact to your provider.';
    }

    public static function staffHasLeft(){
        $regineData = Staff::where([
            ['user_id', Auth::user()->id],
            ['school_id', Auth::getSchool()]
        ])->select(array('regine'))->first();

        if ($regineData->regine){
            return true;
        }
        return false;
    }
}
