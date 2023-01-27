<?php

namespace Modules\Payment\Listeners;

use Modules\Payment\Notifications\SendSattlmentRequestNotifToManagment;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class SendSattlementNotificationListener
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
            $management->notify(new SendSattlmentRequestNotifToManagment($event->user));
        }
    }
}
