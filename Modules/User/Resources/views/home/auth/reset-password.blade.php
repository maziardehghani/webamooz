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
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <form action="/reset-password" class="form" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ request('token')}}">
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" class="txt txt-l" required
                   autocomplete="email" name="email" value="{{old('email')}}" placeholder="ایمیل *">
            @error('email')
            <div class="input-error-validation text-danger">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            <input type="text" class="txt txt-l z " required
                   autocomplete="new-password" name="password" value="{{old('password')}}" placeholder="رمز عبور *">
            @error('password')
            <div class=" text-danger">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            <input type="text" class="txt txt-l " required
                   name="password_confirmation" placeholder="تایید رمز عبور *">
            @error('password_confirmation')
            <div class="text-danger">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            <button class="btn btn-recoverpass">بازیابی</button>
        </div>
        <div class="form-footer">
            <button type="submit">صفحه ورود</button>
        </div>
    </form>
@endsection
