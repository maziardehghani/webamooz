@extends('user::home.auth.master')
@section('content')
    <form action="{{'email/verification-notification'}}" method="post">
        @csrf
        <a class="account-logo" href="">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" class="txt " name="email" required
                   placeholder="ایمیل">
        </div>
        <div class="form-footer">
            <button type="submit" class="btn-register">ارسال مجدد</button>
        </div>
    </form>
@endsection
