@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.payments')}}" title="درخواست تسویه حساب">درخواست تسویه حساب</a></li>
@endsection
@section('content')
    <form action="{{route('dashboard.sattlement.store' , auth()->id())}}" method="post" class="padding-30 bg-white font-size-14">
        @csrf
        <input name="name" value="{{old('name')}}" type="text" placeholder="نام صاحب حساب" class="text" required>
        @error('name')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="cart" value="{{old('cart')}}" type="text" placeholder="شماره حساب" class="text" required>
        @error('cart')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="amount" value="{{old('amount')}}" type="text" placeholder="مبلغ به تومان" class="text" required>
        @error('amount')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <div class="row no-gutters border-2 margin-bottom-15 text-center ">
            <div class="w-50 padding-20 w-50">موجودی قابل برداشت :‌</div>
            <div class="bg-fafafa padding-20 w-50"> {{auth()->user()->balance}} تومان</div>
        </div>
        <div class="row no-gutters border-2 text-center margin-bottom-15">
            <div class="w-50 padding-20">حداکثر زمان واریز :‌</div>
            <div class="w-50 bg-fafafa padding-20">۳ روز</div>
        </div>
        <button class="btn btn-webamooz_net">درخواست تسویه</button>
    </form>
@endsection
