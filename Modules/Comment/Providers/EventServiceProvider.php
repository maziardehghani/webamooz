<?php

namespace Modules\Comment\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Comment\Event\CommentSubmittedEvent;
use Modules\Comment\Listeners\SendCommentSubmittedListener;
use Modules\Course\Listeners\registerUserInTheCourse;
use Modules\Payment\Events\paymentWasSuccessful;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentSubmittedEvent::class => [
            SendCommentSubmittedListener::class
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
