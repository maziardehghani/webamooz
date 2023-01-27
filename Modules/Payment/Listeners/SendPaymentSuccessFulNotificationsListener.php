<?php

namespace Modules\Payment\Listeners;

use Modules\Payment\Notifications\PaymentWasSuccessfulNotification;

class SendPaymentSuccessFulNotificationsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->payment->seller->notify(new PaymentWasSuccessfulNotification($event->payment));
    }
}
