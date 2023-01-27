@extends('front::layouts.master')
@section('content')
    <div class="content">
    <div class="container">
        <div class="modal-header">
            <p>کد تخفیف را وارد کنید</p>
            <div class="close">&times;</div>
        </div>
        <div class="modal-body">
            <form id="codeSender" method="post" action="{{route('Front.discount' , $course->id)}}">
             @csrf
                <div>
                    <input value="" type="text" name="code" id="StartCode" class="txt" placeholder="کد تخفیف را وارد کنید">
                    <p id="response"></p>
                </div>
                <button type="submit" class="btn i-t ">اعمال
                    <img src="{{asset('/img/loading.gif')}}" alt="" id="loading" class="loading d-none">
                </button>

            </form>
            <form method="post" action="{{route('dashboard.courses.buy' , $course->id)}}">
                @csrf
                <input name="code" value="{{session('code') ? session('code') : '' }}" hidden>

                <table class="table text-center table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>قیمت کل دوره</th>
                        <td> {{number_format($course->getPrice())}}تومان</td>
                    </tr>
                    <tr>
                        <th>درصد تخفیف</th>
                        <td><span id="discountPercent" data-value="@if(session('PercentAfterDiscount')){!! number_format(session('PercentAfterDiscount')) !!}@else {{number_format($course->discountPercent())}} @endif">
                                @if(session('PercentAfterDiscount')){!! number_format(session('PercentAfterDiscount')) !!}@else {{number_format($course->discountPercent())}} @endif</span>%</td>
                    </tr>
                    <tr>
                        <th> مبلغ تخفیف</th>
                        <td class="text-red"><span
                                id="discountAmount" data-value="@if(session('AmountAfterDiscount')){!! number_format(session('AmountAfterDiscount')) !!}@else {{number_format($course->discountAmount())}} @endif">
                                @if(session('AmountAfterDiscount')){!! number_format(session('AmountAfterDiscount')) !!}@else {{number_format($course->discountAmount())}} @endif</span> تومان
                        </td>
                    </tr>
                    <tr>
                        <th> قابل پرداخت</th>
                        <td class="text-blue"><span
                                id="payableAmount" data-value="@if(session('finalPriceAfterDiscount')){!! number_format(session('finalPriceAfterDiscount')) !!}@else {{number_format($course->FinalPrice())}} @endif">
                                @if(session('finalPriceAfterDiscount')){!! number_format(session('finalPriceAfterDiscount')) !!}@else {{number_format($course->FinalPrice())}} @endif</span> تومان
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn i-t ">پرداخت آنلاین</button>
            </form>
        </div>
    </div>
    </div>
@endsection
