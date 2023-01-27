@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.discounts')}}" title="تخفیف ها">تخفیف ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0 discounts">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">تخفیف ها</p>
                <div class="table__box">
                    <div class="table-box">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>دوره</th>
                                <th>درصد</th>
                                <th>کد تخفیف</th>
                                <th>محدودیت زمانی</th>
                                <th>محدودیت اتفاده</th>
                                <th>توضیحات</th>
                                <th>استفاده شده</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discounts as $discount)
                            <tr role="row" class="">
                                <td><a href="">{{$discount->discountable->title}}</a></td>
                                <td><a href="">{{$discount->percent}}</a></td>
                                <td><a href="">{{$discount->code}}</a></td>
                                <td>{{verta($discount->expire_at)->formatDifference()}}</td>
                                <td>{{$discount->usage_limitation}}</td>
                                <td>{{$discount->description}}</td>
                                <td>{{$discount->uses}} نفر</td>
                                <td>
                                    <a href="{{route('dashboard.discounts.delete' , $discount->id)}}" class="item-delete mlg-15"></a>
                                    <a href="edit-discount.html" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('discount::layouts.create')
        </div>
@endsection
