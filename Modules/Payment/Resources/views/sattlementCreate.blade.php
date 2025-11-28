@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.payments')}}" title="Settlement Request">Settlement Request</a></li>
@endsection
@section('content')
    <form action="{{route('dashboard.sattlement.store' , auth()->id())}}" method="post" class="padding-30 bg-white font-size-14">
        @csrf
        <input name="name" value="{{old('name')}}" type="text" placeholder="Account Holder Name" class="text" required>
        @error('name')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="cart" value="{{old('cart')}}" type="text" placeholder="Account Number" class="text" required>
        @error('cart')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="amount" value="{{old('amount')}}" type="text" placeholder="Amount in Toman" class="text" required>
        @error('amount')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <div class="row no-gutters border-2 margin-bottom-15 text-center ">
            <div class="w-50 padding-20 w-50">Withdrawable Balance: </div>
            <div class="bg-fafafa padding-20 w-50"> {{auth()->user()->balance}} Toman</div>
        </div>
        <div class="row no-gutters border-2 text-center margin-bottom-15">
            <div class="w-50 padding-20">Maximum Transfer Time: </div>
            <div class="w-50 bg-fafafa padding-20">3 Days</div>
        </div>
        <button class="btn btn-webamooz_net">Request Settlement</button>
    </form>
@endsection
