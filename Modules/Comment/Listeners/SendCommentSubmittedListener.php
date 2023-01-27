<?php

namespace Modules\Comment\Listeners;

use Modules\Comment\Notifications\CommentSubmittedNotif;

class SendCommentSubmittedListener
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
        if ($event->comment->commentable->teacher->id != $event->comment->user_id)
            $event->comment->commentable->teacher->notify(new CommentSubmittedNotif($event->comment));
    }
}
