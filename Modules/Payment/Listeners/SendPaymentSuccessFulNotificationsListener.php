<?php

namespace Modules\Payment\Listeners;

use Modules\Payment\Jobs\sendSuccessfulPaymentEmail;
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
        sendSuccessfulPaymentEmail::dispatch($event->payment)->onQueue('payment_email')->delay(now()->addSeconds(config('payment.email.delay')));
    }
}
