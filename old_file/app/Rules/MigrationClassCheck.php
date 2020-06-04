<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MigrationClassCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $master_classes;

    public function __construct($master_classes)
    {
        $this->master_classes=$master_classes;
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
        if(in_array(($value+1),$this->master_classes)){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Couldn't migration this class..!";
    }
}
