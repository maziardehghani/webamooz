@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.payments')}}" title="My Purchases">My Purchases</a></li>
@endsection
@section('content')
    <div class="table__box">
        <table class="table">
            <thead>
            <tr class="title-row">
                <th>Course Title</th>
                <th>Payment Date</th>
                <th>Amount Paid</th>
                <th>Payment Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($purchases as $purchase)

                <tr>
                    <td><a href="{{$purchase->paymentable->path()}}" target="_blank">{{$purchase->paymentable->title}}</a></td>
                    <td>{{verta($purchase->created_at)}}</td>
                    <td>{{$purchase->amount}} Toman</td>
                    <td class="{{$purchase->status == \Modules\Payment\Models\Payment::STATUS_SUCCESS ? 'text-success' : ' text-error '}}"> @lang($purchase->status)</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        Pagination goes here

    </div>

@endsection
