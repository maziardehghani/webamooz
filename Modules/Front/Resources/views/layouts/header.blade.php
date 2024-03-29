<header class="t-header">
{{--    <div class="campaign">--}}
{{--        <div class="container">--}}
{{--            <a class="message">تخفیف «۳۰٪» همه دوره‌ها فقط تا</a>--}}
{{--            <div id="count-down-timer" data-countdown="2021-07-8 00:00:00" class="count-down-timer"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="container">
        <div class="t-header-row">
            <div class="t-header-right">
                <div class="t-header-logo"><a href="/"></a></div>
                <div class="t-header-search">
                    <form action="{{route('Front.search')}}" method="post">
                        @csrf
                        <div class="t-header-searchbox">
                            <input name="searchBox" type="text" placeholder="جستجو دوره ها" >
                        </div>
                    </form>

                </div>
            </div>
            <div class="t-header-left">
                <div class="icons">
                    <div class="search-icon"></div>
                    <div class="menu-icon"></div>

                </div>

{{--                <div class="join-teachers">--}}
{{--                    <a href="become-a-teacher.html">تدریس در وب آموز</a>--}}
{{--                </div>--}}
                @auth()
                <div class="user-menu-account">
                    <div class="user-image">
                        <img src="{{auth()->user()->thumb}}" alt="{{auth()->user()->name}}">
                    </div>
                    <span>پروفایل کاربری من </span>
                    <div class="user-menu-account-dropdown">
                        <ul>
                            <li><a href="{{route('dashboard.users.profile')}}">مشاهده پروفایل</a></li>
                            <li><a href="{{route('dashboard.myShop.index')}}">خرید های من</a></li>
                            <li><a href="{{route('dashboard')}}">داشبورد</a></li>
                            <li><a href="{{route('dashboard.users.logout')}}">خروج</a></li>
                        </ul>
                    </div>
                </div>
                @endauth
                @guest()
                <div class="login-register-btn ">
                    <div><a class="btn-login" href="{{route('login')}}">ورود</a></div>
                    <div><a class="btn-register" href="{{route('register')}}">ثبت نام</a></div>
                </div>

                @endguest
            </div>
        </div>
    </div>
    <nav id="navigation" class="navigation">
        <!--        بعد از لاگین توی حالت رسپانسیو-->
        <div class="after-login d-none">
          <a href="{{route('dashboard.users.profile')}}">مشاهده پروفایل</a>
          <a href="">خرید های من</a>
          <a href="{{route('dashboard')}}">داشبورد</a>
          <a href="{{route('dashboard.users.logout')}}">خروج</a>
        </div>
        <!---->
        <div class="login-register-btn d-none">
            <div><a class="btn-login" href="{{route('login')}}">ورود</a></div>
            <div><a class="btn-register" href="{{route('register')}}">ثبت نام</a></div>
        </div>
        <div class="container">
                <ul class="nav">
                    @foreach($categories as $category)

                    <li class="main-menu {{count($category->subCategory) ? 'has-sub' : ''}}"><a href="{{$category->path()}}">{{$category->title}}</a>
                        @if(count($category->subCategory))
                        @endif
                        <div class="sub-menu">
                            <div class="container">
                                @foreach($category->subCategory as $subCategory)
                                <div><a href="{{$subCategory->path()}}">{{$subCategory->title}}</a></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="triangle"></div>
                    </li>
                    @endforeach
                   </ul>


            <ul>
                <div class="dark-light">
                    <svg class="moon" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                    <svg class="sun" fill="#ffce45" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M277.3 32h-42.7v64h42.7V32zm129.1 43.7L368 114.1l29.9 29.9 38.4-38.4-29.9-29.9zm-300.8 0l-29.9 29.9 38.4 38.4 29.9-29.9-38.4-38.4zM256 128c-70.4 0-128 57.6-128 128s57.6 128 128 128 128-57.6 128-128-57.6-128-128-128zm224 106.7h-64v42.7h64v-42.7zm-384 0H32v42.7h64v-42.7zM397.9 368L368 397.9l38.4 38.4 29.9-29.9-38.4-38.4zm-283.8 0l-38.4 38.4 29.9 29.9 38.4-38.4-29.9-29.9zm163.2 48h-42.7v64h42.7v-64z"></path>
                    </svg>
                </div>

            </ul>
        </div>
    </nav>
</header>
