@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.payments')}}" title="خرید های من">خرید های من</a></li>
@endsection
@section('content')
        <div class="table__box">
            <table  class="table">
                <thead>
                <tr class="title-row">
                    <th>عنوان دوره</th>
                    <th>تاریخ پرداخت</th>
                    <th>مقدار پرداختی</th>
                    <th>وضعیت پرداخت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($purchases as $purchase)

                    <tr>
                    <td><a href="{{$purchase->paymentable->path()}}" target="_blank">{{$purchase->paymentable->title}}</a></td>
                    <td>{{verta($purchase->created_at)}}</td>
                    <td>{{$purchase->amount}} تومان</td>
                    <td class="{{$purchase->status == \Modules\Payment\Models\Payment::STATUS_SUCCESS ? 'text-success' : ' text-error '}}"> @lang($purchase->status)</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            محل قرار گیری صفحه بندی

        </div>

@endsection
