@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.payments')}}" title="تراکنش ها">تراکنش ها</a></li>
@endsection
@section('content')
<div class="main-content font-size-13">
    <div class="row no-gutters  margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش ۳۰ روز گذشته  سایت </p>
            <p>{{number_format($AllLast30DaysSells)}} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>درامد خالص ۳۰ روز گذشته سایت</p>
            <p>{{number_format($LastDaysSiteShare)}} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش سایت</p>
            <p>{{number_format($AllSells)}} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> کل درآمد خالص سایت</p>
            <p>{{number_format($AllSiteShare)}} تومان</p>
        </div>
    </div>
    <div class="row no-gutters border-radius-3 font-size-13">
        <div class="col-12 bg-white padding-30 margin-bottom-20">
            محل نمودار درامد سی روز گذاشته
        </div>

    </div>
    <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
        <p class="margin-bottom-15">همه تراکنش ها</p>
        <div class="t-header-search">
            <form action="">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تراکنش">
                    <div class="t-header-search-content ">
                        <input name="email" type="text"  class="text"  placeholder="ایمیل">
                        <input name="amount" type="text"  class="text"  placeholder="مبلغ به تومان">
                        <input name="invoice_id" type="text"  class="text" placeholder="شماره">
                        <input name="_start" type="text"  class="text" placeholder="از تاریخ : 1399/10/11">
                        <input name="_end" type="text" class="text margin-bottom-20"  placeholder="تا تاریخ : 1399/10/12">
                        <button type="submit" class="btn btn-webamooz_net" >جستجو</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table__box">
        <table width="100%" class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>شناسه پرداخت</th>
                <th>شماره تراکنش</th>
                <th>نام و نام خانوادگی</th>
                <th>ایمیل پرداخت کننده</th>
                <th>مبلغ (تومان)</th>
                <th>درامد مدرس</th>
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
                <td><a href="">{{$loop->iteration}}</a></td>
                <td><a href="">{{$payment->buyer->name}}</a></td>
                <td><a href="">{{$payment->invoice_id}}</a></td>
                <td><a href="">{{$payment->buyer->email}}</a></td>
{{--                <td><a href="">6037691581560950</a></td>--}}
                <td><a href="">{{$payment->amount}}</a></td>
                <td><a href="">{{$payment->seller_share}}</a></td>
                <td><a href="">{{$payment->site_share}}</a></td>
                <td><a href="">{{$payment->paymentable->title}}</a></td>
                <td><a href=""> {{verta($payment->created_at)}}</a></td>
                <td><a href="" class="{{$payment->status == \Modules\Payment\Models\Payment::STATUS_SUCCESS? 'text-success':'text-error'}}">@lang($payment->status)</a></td>
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
@endsection
