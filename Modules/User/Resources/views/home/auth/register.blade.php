@extends('user::home.auth.master')

@section('content')

    <form action="" class="form" method="post">
        <a class="account-logo" href="{{route('Front.index')}}">
            <img src="{{asset('img/weblogo.png')}}" alt="Logo">
        </a>

        <div class="form-content form-account">
            <form action="{{route('register')}}" method="post">
                @csrf

                <input type="text" class="txt" required autocomplete="name"
                       name="name" value="{{old('name')}}" placeholder="Full Name *">
                @error('name')
                <div class="input-error-validation text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <input type="text" class="txt txt-l" required
                       autocomplete="email" name="email" value="{{old('email')}}" placeholder="Email Address *">
                @error('email')
                <div class="input-error-validation text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <input type="text" class="txt txt-l"
                       autocomplete="mobile" name="mobile" value="{{old('mobile')}}" placeholder="Mobile Number">
                @error('mobile')
                <div class="input-error-validation text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <input type="password" class="txt txt-l z" required
                       autocomplete="new-password" name="password" value="{{old('password')}}" placeholder="Password *">
                @error('password')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <input type="password" class="txt txt-l" required
                       name="password_confirmation" placeholder="Confirm Password *">
                @error('password_confirmation')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <span class="rules">
                    Password must be at least 6 characters long and include
                    uppercase and lowercase letters, numbers, and special characters such as !@#$%^&*().
                </span>

                <br>
                <button class="btn continue-btn">Register and Continue</button>

                <div class="form-footer">
                    <a style="color: #10430a" href="{{route('login')}}">Login Page</a>
                </div>
            </form>
        </div>
    </form>

@endsection
