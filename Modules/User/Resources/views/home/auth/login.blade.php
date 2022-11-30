@extends('user::home.auth.master')
@section('content')
    <form action="{{route('login')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" name="email" class="txt-l txt " required
                   autocomplete="email" value="{{old('email')}}" placeholder="ایمیل یا شماره موبایل">
            @error('email')
            <div class=" text-danger">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            {{--            <input type="text" name="mobile" class="txt-l txt " required--}}
            {{--                   autocomplete="mobile" value="{{old('mobile')}}" placeholder="ایمیل یا شماره موبایل">--}}
            {{--            @error('mobile')--}}
            {{--            <div class=" text-danger">--}}
            {{--                <strong>{{ $message }}</strong>--}}
            {{--            </div>--}}
            {{--            @enderror--}}
            <input type="text" name="password" class="txt-l txt " required
                   autocomplete="new-password" value="{{old('password')}}" placeholder="رمز عبور">
            @error('password')
            <div class=" text-danger">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input type="checkbox" checked="checked" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="{{'forgot-password'}}">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{route('register')}}">صفحه ثبت نام</a>
        </div>
    </form>
@endsection
