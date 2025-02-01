@extends('dashboard::layouts.master')

@section('content')
    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_TEACHER)
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> موجودی حساب فعلی </p>
            <p>{{number_format(auth()->user()->balance)}} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> کل فروش دوره ها</p>
            <p>{{number_format($totalCourseSale)}} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> کارمزد کسر شده </p>
            <p>{{number_format($site_share)}} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> درآمد خالص </p>
            <p>{{number_format($pureTeachPayment)}} تومان</p>
        </div>
    </div>
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> درآمد امروز </p>
            <p>{{number_format($todayPayment)}} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> درآمد 30 روز گذاشته</p>
            <p>{{number_format($lastMonthPayment)}} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> تسویه حساب در حال انجام </p>
            <p>0 تومان </p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
            <p>تراکنش های موفق امروز ({{$todaytransactionsCount}}) تراکنش </p>
            <p>{{number_format($todaySuccessfulPayments)}} تومان</p>
        </div>
    </div>
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
            محل قرار گیری نمودار
        </div>
        <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

            <p class="title icon-outline-receipt">موجودی قابل تسویه </p>
            <p class="amount-show color-444">{{number_format(auth()->user()->balance)}} <span> تومان </span></p>
            <p class="title icon-sync">در حال تسویه</p>
            <p class="amount-show color-444">0<span> تومان </span></p>
            <a href="/" class=" all-reconcile-text color-2b4a83">همه تسویه حساب ها</a>
        </div>
    </div>
    @endcan
    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
    <div class="row bg-white no-gutters font-size-13">
        <div class="title__row">
            <p>تراکنش های اخیر شما</p>
            <a class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه تراکنش ها</a>
        </div>
        <div class="table__box">
            <table width="100%" class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>نام پرداخت کننده</th>
                    <th>شناسه پرداخت</th>
                    <th>ایمیل پرداخت کننده</th>
                    <th>مبلغ (تومان)</th>
                    <th>درامد شما</th>
                    <th>درامد سایت</th>
                    <th>نام دوره</th>
                    <th>تاریخ و ساعت</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr role="row">
                        <td><a href="">{{$payment->buyer->name}}</a></td>
                        <td><a href="">{{$payment->invoice_id}}</a></td>
                        <td><a href="">{{$payment->buyer->email}}</a></td>
                        <td><a href="">{{$payment->amount}}</a></td>
                        <td><a href="">{{$payment->seller_share}}</a></td>
                        <td><a href="">{{$payment->site_share}}</a></td>
                        <td><a href="">{{$payment->paymentable?->title}}</a></td>
                        <td><a href=""> {{verta($payment->created_at)}}</a></td>
                        <td><a href="" class="{{$payment->status == \Modules\Payment\Models\Payment::STATUS_SUCCESS? 'text-success':'text-error'}}">{{$payment->status}}</a></td>
                        <td>
                            <a href="" class="item-delete mlg-15"></a>
                            <a href="edit-transaction.html" class="item-edit"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endcan
@endsection

