<?php

namespace Modules\Payment\Listeners;

class AddSellerShareToHisAccount
{

    public function __construct()
    {
        //
    }
    public function handle($event)
    {
        if ($event->payment->seller)
        {
            $event->payment->seller->balance += $event->payment->seller_share ;
            $event->payment->seller->save();
        }
    }
}
