<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Result;

class ResultEntryCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $data;
    protected $student_id;
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
        $this->student_id=$attribute;
        $result = Result::where([
            'exam_type_id'=>$this->data['exam_type_id'],
            'exam_year'=>$this->data['exam_year'],
            'student_id'=>$value,
            'school_id'=>Auth::getSchool()
        ])->first();
        if($this->id==NULL){
            if($result){
             return false;
            }
            return true;
        }else{

            if($result->student_id==$this->id){
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
        return 'The '.$this->student_id.' has already been taken.';
    }
}
