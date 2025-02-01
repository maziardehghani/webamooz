@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.payments')}}" title="Settlements">Settlements</a></li>
@endsection
@section('content')
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item is-active" href="">All Settlements</a>
            <a class="tab__item" href="">New Settlements</a>
            <a class="tab__item" href="checkouts.html">Settled Payments</a>
            <a class="tab__item" href="{{route('dashboard.sattlement.create')}}">Request New Settlement</a>
        </div>
    </div>
    <div class="bg-white padding-20">
        <div class="t-header-search">
            <form action="" onclick="event.preventDefault();">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13"
                           placeholder="Search Settlements">
                    <div class="t-header-search-content">
                        <input type="text" class="text" placeholder="Card Number">
                        <input type="text" class="text" placeholder="Number">
                        <input type="text" class="text" placeholder="Date">
                        <input type="text" class="text" placeholder="Email">
                        <input type="text" class="text margin-bottom-20" placeholder="Full Name">
                        <button class="btn btn-webamooz_net">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table__box">
        <form>
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>Settlement ID</th>
                    <th>User</th>
                    <th>Destination</th>
                    <th>Card Number</th>
                    <th>Deposit Request Date</th>
                    <th>Deposited Date</th>
                    <th>Amount (Toman)</th>
                    <th>Status</th>
                    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
                        <th>Actions</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach($sattlements as $sattlement)
                    <tr role="row">
                        <td><a href="">{{$sattlement->transaction_id}}</a></td>
                        <td><a href="">{{$sattlement->user->name}}</a></td>
                        <td><a href="">{{$sattlement->to['name']}}</a></td>
                        <td><a href="">{{$sattlement->to['cart']}}</a></td>
                        <td><a href="">{{verta($sattlement->created_at)->formatDifference()}}</a></td>
                        <td><a href="">{{verta($sattlement->sattlement_at)->formatDifference()}}</a></td>
                        <td><a href="">{{number_format($sattlement->amount)}}</a></td>
                        <td>
                            <a href="" class="{{$sattlement->status==\Modules\Payment\Models\Sattlement::STATUS_SETTLED?'text-success': 'text-error'}}">
                                @lang($sattlement->status)
                            </a>
                        </td>
                        <td>
                            @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
                                @if($sattlement->status == \Modules\Payment\Models\Sattlement::STATUS_PENDING)
                                    <a href="{{route('dashboard.sattlement.rejected' , $sattlement->id)}}"  class="item-reject mlg-15" title="Reject"></a>
                                    <a href="{{route('dashboard.sattlement.settled' , $sattlement->id)}}" onclick="submit()"  class="item-confirm mlg-15" title="Approve"></a>
                                    <a href="{{route('dashboard.sattlement.edit' , $sattlement->id)}}" class="item-edit" title="Edit"></a>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>

@endsection
