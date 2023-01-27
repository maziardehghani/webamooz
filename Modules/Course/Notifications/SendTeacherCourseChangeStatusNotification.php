<?php

namespace Modules\Course\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Course\Models\courses;

class SendTeacherCourseChangeStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $course;
    public $status;
    public function __construct($course , $status)
    {
        $this->course = $course;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($this->status == courses::CONFIRMATION_STATUS_ACCEPTED)
        {
            return [
                'message' => 'دوره شما توسط مدیر سایت تایید شد',
                'url' => $this->course->path(),
            ];
        }elseif ($this->status == courses::CONFIRMATION_STATUS_REJECTED)
        {
            return [
                'message' => 'دوره شما توسط مدیر سایت رد شد',
                'url' => ''
            ];
        }

    }
}
