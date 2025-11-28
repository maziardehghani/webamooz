<?php

namespace Modules\Payment\Listeners;

use Modules\Payment\Notifications\SendSettledNotification;

class SendSettledNotificationListener
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
        $event->user->notify(new SendSettledNotification());
    }
}
