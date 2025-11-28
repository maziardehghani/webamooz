<?php

namespace Modules\Comment\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kavenegar\LaravelNotification\KavenegarChannel;
use Modules\Comment\Mail\CommentSubmittedMail;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class CommentSubmittedNotif extends Notification
{
    use Queueable;


    public $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channel = [];
          $channel[]= 'database';
//        $channel[]= 'mail';
//        if (! is_null($notifiable->mobile)) $channel[] = KavenegarChannel::class;
//        if (! is_null($notifiable->telegram)) $channel[] = TelegramChannel::class;  cant use Telegram Notification cause of filtering issue

        return $channel;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new CommentSubmittedMail($this->comment))->to($notifiable->email);
    }
    public function toSMS($notifiable)
    {
        return 'شما یک کامنت جدید دارید';
    }
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->telegram)
            ->content("مدرس گرامی شما یک کامنت جدید دارید")
            ->button('مشاهده دوره', $this->comment->commentable->path())
            ->button('مدیریت دیدگاه', route('dashboard.comments'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'شما یک کامنت جدید دارید',
            'url' => $this->comment->commentable->path(),
            'url_text' => 'مشاهده دوره',
        ];
    }
}
