<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Student;
use App\Staff;
use Auth;
use App\Http\Controllers\Controller;


class IdCardNumberCheck implements Rule
{
    protected $key_name;
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->key_name=$attribute;
        $lenth=strlen($value);
        if($lenth!=12 && $lenth!=15 && $lenth!=24 && $lenth!=30){
            return false;
        }
        if($lenth==30){
          $value=substr($value, 0,15);
        }
        if($lenth==24){
          $value=substr($value, 0,12);
        }


        if(strlen($value)==15){
            $result=Student::where(['school_id'=>Auth::getSchool(),'student_id'=>$value])->first();
            $con=new Controller();
            if($result==NULL || ($con->school()->service_type_id==1 && $result->id_card_exits==0)){
              return false;
            }
        }else{
          $result=Staff::where(['school_id'=>Auth::getSchool(),'staff_id'=>$value])->first();  
        }

        

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The '.$this->key_name.' invalid !!';
    }
}
