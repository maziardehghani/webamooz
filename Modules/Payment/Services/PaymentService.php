<?php

namespace Modules\Payment\Services;

use Modules\Payment\GateWays\ZarinPal\GateWay;
use Modules\Payment\Models\Payment;
use Modules\Payment\Repasitories\paymentRepository;
use Modules\User\Models\User;

class PaymentService
{
    public static function generate($amount , $paymentable , User $buyer , $seller_id = null)
    {
        if ($amount <= 0 || is_null($paymentable->id) || is_null($buyer->id))
            return false;

        $gateway = resolve(GateWay::class);
        $invoice_id = $gateway->request($amount , $paymentable->title);

        if (is_array($invoice_id))
        {
            dd($invoice_id);
        }

        if (!is_null($paymentable->percent))
        {
            $seller_percent = $paymentable->percent;
            $seller_share = ($amount / 100)  * $seller_percent;
            $site_share = $amount-$seller_share;
        }else
        {
            $seller_percent = $seller_share = 0;
            $site_share = $amount;
        }
        $paymentRepository = (new paymentRepository());
        return $paymentRepository->store([
            'buyer_id'=> $buyer->id,
            'seller_id' =>$seller_id,
            'paymentable_id'=>$paymentable->id,
            'paymentable_type'=>get_class($paymentable),
            'amount'=>$amount,
            'invoice_id'=>$invoice_id,
            'gateWay'=>$gateway->getName(),
            'status'=>Payment::STATUS_PENDING,
            'seller_percent'=> $seller_percent,
            'seller_share'=>$seller_share,
            'site_share'=>$site_share,
        ]);
    }

}
