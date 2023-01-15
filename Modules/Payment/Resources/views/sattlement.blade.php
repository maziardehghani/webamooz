@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.payments')}}" title=" تسویه حساب"> تسویه حساب</a></li>
@endsection
@section('content')
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href=""> همه تسویه ها</a>
                <a class="tab__item " href="">تسویه های جدید</a>
                <a class="tab__item " href="checkouts.html">تسویه های واریز شده</a>
                <a class="tab__item " href="{{route('dashboard.sattlement.create')}}">درخواست تسویه جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13"
                               placeholder="جستجوی در تسویه حساب ها">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="شماره کارت">
                            <input type="text" class="text" placeholder="شماره">
                            <input type="text" class="text" placeholder="تاریخ">
                            <input type="text" class="text" placeholder="ایمیل">
                            <input type="text" class="text margin-bottom-20" placeholder="نام و نام خانوادگی">
                            <btutton class="btn btn-webamooz_net">جستجو</btutton>
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
                        <th>شناسه تسویه</th>
                        <th>کاربر</th>
                        <th>مقصد</th>
                        <th>شماره کارت</th>
                        <th>تاریخ درخواست واریز</th>
                        <th>تاریخ واریز شده</th>
                        <th>مبلغ (تومان )</th>
                        <th>وضعیت</th>
                        @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
                        <th>عملیات</th>
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
                                    <a href="{{route('dashboard.sattlement.rejected' , $sattlement->id)}}"  class="item-reject mlg-15" title="رد"></a>
                                    <a href="{{route('dashboard.sattlement.settled' , $sattlement->id)}}" onclick="submit()"  class="item-confirm mlg-15" title="تایید"></a>
                                    <a href="{{route('dashboard.sattlement.edit' , $sattlement->id)}}" class="item-edit " title="ویرایش"></a>
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
