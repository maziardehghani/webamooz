<?php

namespace Modules\Comment\Rules;

use Illuminate\Contracts\Validation\Rule;

class commentableRule implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
       return class_exists($value) && method_exists($value , 'comments');
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
