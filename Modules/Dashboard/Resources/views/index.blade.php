@extends('dashboard::layouts.master')

@section('content')
    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_TEACHER)
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> Current Account Balance </p>
                <p>{{number_format(auth()->user()->balance)}} Toman</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> Total Course Sales</p>
                <p>{{number_format($totalCourseSale)}} Toman</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> Deducted Commission </p>
                <p>{{number_format($site_share)}} Toman</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
                <p> Net Income </p>
                <p>{{number_format($pureTeachPayment)}} Toman</p>
            </div>
        </div>
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> Today's Income </p>
                <p>{{number_format($todayPayment)}} Toman</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> Last 30 Days Income</p>
                <p>{{number_format($lastMonthPayment)}} Toman</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> Reconciliation in Progress </p>
                <p>0 Toman </p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
                <p> Successful Transactions Today ({{$todaytransactionsCount}}) Transactions </p>
                <p>{{number_format($todaySuccessfulPayments)}} Toman</p>
            </div>
        </div>
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
                Chart Placement Area
            </div>
            <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

                <p class="title icon-outline-receipt">Available Balance for Reconciliation</p>
                <p class="amount-show color-444">{{number_format(auth()->user()->balance)}} <span> Toman </span></p>
                <p class="title icon-sync">In Progress Reconciliation</p>
                <p class="amount-show color-444">0<span> Toman </span></p>
                <a href="/" class=" all-reconcile-text color-2b4a83">All Reconciliations</a>
            </div>
        </div>
    @endcan
    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
        <div class="row bg-white no-gutters font-size-13">
            <div class="title__row">
                <p>Your Recent Transactions</p>
                <a class="all-reconcile-text margin-left-20 color-2b4a83">View All Transactions</a>
            </div>
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>Payer's Name</th>
                        <th>Payment ID</th>
                        <th>Payer's Email</th>
                        <th>Amount (Toman)</th>
                        <th>Your Earnings</th>
                        <th>Site Earnings</th>
                        <th>Course Name</th>
                        <th>Date and Time</th>
                        <th>Status</th>
                        <th>Actions</th>
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
