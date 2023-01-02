<?php

namespace Modules\Course\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Course\Repository\SeasonRepository;
use Modules\User\Repositories\UserRepository;

class ValidSeason implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
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
        if ((new SeasonRepository())->findByIdAndCourseId($value , request()->route('course')))
            return true;
        return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'سرفصل انتخاب شده یک سرفصل معتبر نمی باشد';
    }
}
