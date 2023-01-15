<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Payment\Repasitories\paymentRepository;

class DashboardController extends Controller
{
    public function index(paymentRepository $paymentRepository)
    {
        $totalCourseSale = $paymentRepository->getCourseSuccessfulSells('amount' , auth()->id());
        $pureTeachPayment = $paymentRepository->getCourseSuccessfulSells('seller_share' , auth()->id());
        $site_share = $paymentRepository->getCourseSuccessfulSells('site_share' , auth()->id());
        $todayPayment = $paymentRepository->getCourseSuccessfulSells('seller_share', auth()->id() , -1);
        $lastMonthPayment = $paymentRepository->getCourseSuccessfulSells('seller_share', auth()->id() , -30);
        $todaySuccessfulPayments = $paymentRepository->getCourseSuccessfulSells('amount', auth()->id() , -1);
        $todaytransactionsCount = $paymentRepository->transActionsCount(auth()->id() , -1);

        $payments = $paymentRepository->getSellertransactions(auth()->user());
        return view('dashboard::index' , compact(
            'totalCourseSale' ,
            'pureTeachPayment' ,
            'site_share',
            'todayPayment',
            'lastMonthPayment',
            'todaySuccessfulPayments',
            'todaytransactionsCount',
            'payments'
        ));
    }
}
