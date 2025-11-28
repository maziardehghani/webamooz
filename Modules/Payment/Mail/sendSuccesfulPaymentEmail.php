<?php

namespace Modules\Payment\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendSuccesfulPaymentEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $paymentable;
    public function __construct($paymentable)
    {
        $this->paymentable = $paymentable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('payment::mail.paymentSuccesful-mail')
            ->subject('وب آموز|گزارش خرید');
    }
}
