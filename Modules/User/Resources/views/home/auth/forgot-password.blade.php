@extends('user::home.auth.master')
@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li class="alert-text">
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{'forgot-password'}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input name="email" type="text" class="txt-l txt" placeholder="ایمیل">
            <br>
            <button class="btn btn-recoverpass">بازیابی</button>
        </div>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                <p class="text-success"> {{ 'ما یک ایمیل حاوی لینک تایید برای شما ارسال کردیم' }} </p>
            </div>
        @endif
        <div class="form-footer">
            <a style="color: #10430a" href="{{route('register')}}">صفحه ورود</a>
        </div>
    </form>
@endsection
