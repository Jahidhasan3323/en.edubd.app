<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Result;

class SingleResultEntryCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $data;
    protected $subject_id;
    public function __construct($data)
    {
        $this->data=$data;
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
        $this->subject_id=$attribute;
        $this->data['subject_id']=$value;
        $this->data['school_id']=Auth::getSchool();
        $result = Result::where($this->data)->first();
        if($result){
         return false;
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
        return 'The '.$this->subject_id.' has already been taken.';
    }
}
