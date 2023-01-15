<?php

namespace Modules\Payment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Payment\Events\paymentWasSuccessful;
use Modules\Payment\GateWays\ZarinPal\GateWay;
use Modules\Payment\Models\Payment;
use Modules\Payment\Repasitories\paymentRepository;

class PaymentController extends Controller
{
    private $gateWay = '';
    private $paymentRepository = '';

    public function __construct()
    {
        $this->paymentRepository = (new paymentRepository());

    }

    public function index(Request $request)
    {
        $this->authorize('manage' , Payment::class);

        $payments = $this->paymentRepository
            ->searchEmail($request->email)
            ->searchAmount($request->amount)
            ->searchInvoice_id($request->invoice_id)
            ->searchDateAfter($request->_start)
            ->searchDateBefore($request->_end)
            ->paginate();


        $AllLast30DaysSells = $this->paymentRepository
            ->getSuccessfulSells('amount' , -30);

        $LastDaysSiteShare = $this->paymentRepository
            ->getSuccessfulSells('site_share' , -30);

        $AllSells = $this->paymentRepository
            ->getSuccessfulSells('amount');

        $AllSiteShare = $this->paymentRepository
            ->getSuccessfulSells('site_share');

        return view('payment::index' , compact(
            'payments'
            , 'AllLast30DaysSells'
            , 'LastDaysSiteShare'
            , 'AllSells'
            , 'AllSiteShare'
        ));

    }

    public function callback(Request $request)
    {

        $this->gateWay = resolve(GateWay::class);
        $payment = $this->paymentRepository->findByAuthority($this->gateWay->getInvoice_idFromRequest($request));
        if (!$payment)
        {
//            newFeedback('تراکنش ناموفق' , 'تراکنش مورد نظر یافت نشد' , 'error');
            return redirect()->back();
        }
        $result = $this->gateWay->verify($payment);

        if (is_array($result))
        {

//            newFeedback('تراکنش ناموفق' , $result['message'],'error');
            $this->paymentRepository->changeStatus($payment->id , Payment::STATUS_FAILED);
        }else
        {
            event(new paymentWasSuccessful($payment));
//            newFeedback('تراکنش موفق' , $result['message'],'success');
            $this->paymentRepository->changeStatus($payment->id , Payment::STATUS_SUCCESS);
        }

        return redirect()->to($payment->paymentable->path());

    }

    public function myShop()
    {
        $purchases = auth()->user()->payments;

        return view('payment::myShop' , compact('purchases'));
    }

}

