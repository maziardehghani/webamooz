<!doctype html>
<html lang="en" dir="ltr">
@include('front::layouts.head')
<body>
@include('front::layouts.header')
<main id="index">
    @yield('content')
</main>
@include('front::layouts.footer')
@include('front::layouts.foot')
</body>

</html>

@yield('js')



