<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/ltr.css')}}">
    <link rel="stylesheet" href="{{asset('css/font/font.css')}}">
    <title>صفحه ثبت نام</title>
</head>
<body>
<main>

    <div class="account act">
        <form action="{{route('verification.verify')}}" class="form" method="post">
            @csrf
            <a class="account-logo" href="{{'/'}}">
                <img src="{{asset('img/weblogo.png')}}" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل  <span></span>
                    را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
                </p>
            </div>
            <div class="form-content form-content1">
                <input name="verification_code" class="activation-code-input" placeholder="فعال سازی">
                @error('verification_code')
                <strong>{{$message}}</strong>
                @enderror
                <br>
                <button class="btn i-t">تایید</button>

            </div>
            <div class="form-footer">
                <a href="">صفحه ثبت نام</a>
                <br>
                <a onclick="verifyCodeSend()" style="cursor: pointer">ارسال مجدد کد</a>

            </div>
        </form>
        <form id="resendCode" action="{{route('verification.send')}}" method="post">
            @csrf
        </form>
    </div>
</main>
</body>
<script>
    function verifyCodeSend()
    {
        $("#resendCode").submit();
    }
</script>
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/activation-code.js')}}"></script>
</html>
