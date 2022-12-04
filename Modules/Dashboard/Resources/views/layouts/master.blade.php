<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>Panel</title>
    <link rel="stylesheet" href="{{asset('panel/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('panel/css/responsive_991.css')}}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{asset('panel/css/responsive_768.css')}}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{asset('panel/css/font.css')}}">
</head>

<body>
@include('dashboard::layouts.sideBar')
@yield('css')
<div class="content">
    @include('dashboard::layouts.header')
    @include('dashboard::layouts.breadCrumb')
    <div class="main-content">
        @yield('content')
    </div>
</div>
</body>
<script src="{{asset('panel/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('panel/js/js.js')}}"></script>
@yield('js')
</html>
