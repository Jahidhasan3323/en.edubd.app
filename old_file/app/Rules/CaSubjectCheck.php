<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\CaSubject;

class CaSubjectCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $data;
    protected $id;
    public function __construct($data,$id=NULL)
    {
        $this->data=$data;
        $this->id=$id;
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
        $subject = CaSubject::where([
            'subject_name'=>$value,
            'master_class_id'=>$this->data['master_class_id'],
            'group_class_id'=>$this->data['group_class_id'],
            'school_id'=>Auth::getSchool()
        ])->first();
        if($this->id==NULL){
            if($subject){
             return false;
            }
            return true;
        }else{

            if($subject->id==$this->id){
              return true;
            }
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This subject allready exits.';
    }
}
