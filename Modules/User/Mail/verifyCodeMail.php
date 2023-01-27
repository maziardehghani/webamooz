<?php

namespace Modules\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verifyCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user='';
    public $code='';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {

        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('user::mail.veryfy-mail')
            ->subject('وب آموز|کد فعال سازی');
    }
}
