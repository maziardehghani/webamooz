<?php

namespace Modules\Payment\GateWays\ZarinPal;

use Illuminate\Http\Request;
use Modules\Payment\Contracts\GateWayContract;
use Modules\Payment\Models\Payment;
use Modules\Payment\Repasitories\paymentRepository;

class ZarinpalAdaptor implements GateWayContract
{
    private $url;
    private $client;
    public function request($amount , $description)
    {

        $this->client = new zarinpal();
        $callback = route('payment.callback') ;
        $result = $this->client->request("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" ,$amount  , $description  ,"" , "" ,$callback , true );


        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            $this->url = $result['StartPay'];
            return $result['Authority'];
        } else
        {
            return [
            'status' => $result["Status"],
            'message' => $result["Message"]
            ];
        }
    }
    public function verify(Payment $payment)
    {

        if (!$payment) return false;

        $result = (new zarinpal())->verify('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx' , $payment->amount , true);

        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            return $result["RefID"];

        }else
        {
            return [
                'status' => $result["Status"],
                "message" => $result["Message"]
            ];
        }


        }

    public function redirect()
    {
        $this->client->redirect($this->url);
    }
    public function getName()
    {
        return 'zarinPal';
    }
    public function getInvoice_idFromRequest(Request $request)
    {
        return $request->Authority;
    }
}
