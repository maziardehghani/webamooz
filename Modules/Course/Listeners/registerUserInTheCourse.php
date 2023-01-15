<?php

namespace Modules\Course\Listeners;

use Modules\Course\Models\courses;
use Modules\Course\Repository\CourseRepository;

class registerUserInTheCourse
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (get_class($event->payment->paymentable) == courses::class)
        {
            (new CourseRepository())->addStudentToCourse($event->payment->paymentable , $event->payment->buyer_id);
        }
    }
}
