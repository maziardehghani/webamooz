<?php

namespace Modules\Course\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Course\Listeners\registerUserInTheCourse;
use Modules\Payment\Events\paymentWasSuccessful;
use Modules\Payment\Listeners\AddSellerShareToHisAccount;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        paymentWasSuccessful::class => [
            registerUserInTheCourse::class,
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
