@extends('user::home.auth.master')
@section('content')

    <form action="" class="form" method="post">
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <form action="{{route('register')}}" method="post">
                @csrf
                <input type="text" class="txt " required autocomplete="name"
                       name="name" value="{{old('name')}}" placeholder="نام و نام خانوادگی *">
                @error('name')
                <div class="input-error-validation text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input type="text" class="txt txt-l" required
                       autocomplete="email" name="email" value="{{old('email')}}" placeholder="ایمیل *">
                @error('email')
                <div class="input-error-validation text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input type="text" class="txt txt-l"
                       autocomplete="mobile" name="mobile" value="{{old('mobile')}}" placeholder="شماره همراه">
                @error('mobile')
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
                <span class="rules">
                        رمز عبور باید حداقل ۶ کاراکتر و
                        ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.
                    </span>
                <br>
                <button class="btn continue-btn">ثبت نام و ادامه</button>
                <div class="form-footer">
                    <a href="{{route('login')}}">صفحه ورود</a>
                </div>
            </form>

        </div>
    </form>
@endsection
