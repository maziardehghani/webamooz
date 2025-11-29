@extends('user::home.auth.master')

@section('content')
    <form action="{{ route('login') }}" class="form" method="post">
        @csrf

        <a class="account-logo" href="{{ route('Front.index') }}">
            <img src="{{ asset('img/weblogo.png') }}" alt="Logo">
        </a>

        <div class="form-content form-account">
            <input type="text" name="email" class="txt-l txt" required
                   autocomplete="email"
                   value="{{ old('email') }}"
                   placeholder="Email or Mobile Number">

            @error('email')
            <div class="text-danger">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

            <input type="password" name="password" class="txt-l txt" required
                   autocomplete="new-password"
                   value="{{ old('password') }}"
                   placeholder="Password">

            @error('password')
            <div class="text-danger">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

            <br>
            <button class="btn btn--login">Login</button>

            <div class="recover-password">
                {{-- <a style="color: #10430a" href="{{ 'forgot-password' }}">
                    Forgot Password?
                </a> --}}
            </div>
        </div>

        <div class="form-footer">
            {{-- <a style="color: #10430a" href="{{ route('register') }}">
                Create an Account
            </a> --}}
        </div>

    </form>
@endsection

