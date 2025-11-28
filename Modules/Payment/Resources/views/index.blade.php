@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.payments')}}" title="Transactions">Transactions</a></li>
@endsection
@section('content')
    <div class="main-content font-size-13">
        <div class="row no-gutters margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>Total Sales of the Last 30 Days on the Site</p>
                <p>{{number_format($AllLast30DaysSells)}} $</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>Net Income of the Last 30 Days on the Site</p>
                <p>{{number_format($LastDaysSiteShare)}} $</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>Total Sales of the Site</p>
                <p>{{number_format($AllSells)}} $</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
                <p>Total Net Income of the Site</p>
                <p>{{number_format($AllSiteShare)}} $</p>
            </div>
        </div>
        <div class="row no-gutters border-radius-3 font-size-13">
            <div class="col-12 bg-white padding-30 margin-bottom-20">
                Chart of Income in the Last 30 Days goes here
            </div>
        </div>
        <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
            <p class="margin-bottom-15">All Transactions</p>
            <div class="t-header-search">
                <form action="">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="Search Transaction">
                        <div class="t-header-search-content ">
                            <input name="email" type="text" class="text" placeholder="Email">
                            <input name="amount" type="text" class="text" placeholder="Amount in $">
                            <input name="invoice_id" type="text" class="text" placeholder="Invoice Number">
                            <input name="_start" type="text" class="text" placeholder="From Date: 1399/10/11">
                            <input name="_end" type="text" class="text margin-bottom-20" placeholder="To Date: 1399/10/12">
                            <button type="submit" class="btn btn-webamooz_net">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table width="100%" class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>Payment ID</th>
                    <th>Transaction Number</th>
                    <th>Full Name</th>
                    <th>Paying Email</th>
                    <th>Amount ($)</th>
                    <th>Instructor Income</th>
                    <th>Site Income</th>
                    <th>Course Name</th>
                    <th>Date and Time</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                        <td><a href="">{{$payment->paymentable?->title}}</a></td>
                        <td><a href="">{{verta($payment->created_at)}}</a></td>
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
