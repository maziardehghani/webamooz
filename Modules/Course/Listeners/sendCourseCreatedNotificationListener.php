<?php

namespace Modules\Course\Listeners;

use Modules\Course\Notifications\sendCourseCreatedNotification;
use Modules\Payment\Notifications\SendSattlmentRequestNotifToManagment;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class sendCourseCreatedNotificationListener
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
        $managements = User::permission(Permission::PERMISSION_MANAGEMENT)->get();
        foreach ($managements as $management)
        {
            $management->notify(new sendCourseCreatedNotification($event->course->teacher));
        }
    }
}
