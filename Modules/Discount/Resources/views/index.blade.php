@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.discounts')}}" title="Discounts">Discounts</a></li>
@endsection
@section('content')
    <div class="main-content padding-0 discounts">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">Discounts</p>
                <div class="table__box">
                    <div class="table-box">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>Course</th>
                                <th>Percentage</th>
                                <th>Discount Code</th>
                                <th>Time Limitation</th>
                                <th>Usage Limitation</th>
                                <th>Description</th>
                                <th>Used</th>
                                <th>Actions</th>
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
                                    <td>{{$discount->uses}} people</td>
                                    <td>
                                        <a href="{{route('dashboard.discounts.delete' , $discount->id)}}" class="item-delete mlg-15"></a>
                                        <a href="edit-discount.html" class="item-edit " title="Edit"></a>
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
