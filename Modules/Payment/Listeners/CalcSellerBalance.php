<?php

namespace Modules\Payment\Listeners;

use Modules\Payment\Models\Sattlement;

class CalcSellerBalance
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
        if ($event->statusRequested == Sattlement::STATUS_PENDING)
        {
            if ($event->user->balance > $event->amountRequested)
                $event->user->balance -= $event->amountRequested ;
                $event->user->save();
        }
        elseif ($event->statusRequested == Sattlement::STATUS_REJECTED)
        {
            $event->user->balance += $event->amountRequested ;
            $event->user->save();
        }

    }
}
