<?php

namespace Modules\Course\Listeners;

use Modules\Course\Notifications\SendTeacherCourseChangeStatusNotification;

class sendTeacherCourseChangeStatusNotificationListener
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
        $event->course->teacher->notify(new SendTeacherCourseChangeStatusNotification($event->course , $event->status));
    }
}
