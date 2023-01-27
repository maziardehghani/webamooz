<?php

namespace Modules\Payment\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Payment\Events\paymentWasSuccessful;
use Modules\Payment\Events\SattlementStatusChanged;
use Modules\Payment\Events\settledUserRequest;
use Modules\Payment\Listeners\AddSellerShareToHisAccount;
use Modules\Payment\Listeners\CalcSellerBalance;
use Modules\Payment\Listeners\reduceSellerBalance;
use Modules\Payment\Listeners\SendPaymentSuccessFulNotificationsListener;
use Modules\Payment\Listeners\SendSattlementNotificationListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        paymentWasSuccessful::class => [
            AddSellerShareToHisAccount::class,
        ],

        SattlementStatusChanged::class => [
            CalcSellerBalance::class,
            SendSattlementNotificationListener::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
