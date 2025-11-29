<header class="t-header">
    <div class="container">
        <div class="t-header-row">
            <div class="t-header-right">
                <div class="t-header-logo"><a href="/"></a></div>
                <div class="t-header-search">
                    <form action="{{route('Front.search')}}" method="post">
                        @csrf
                        <div class="t-header-searchbox">
                            <input name="searchBox" type="text" placeholder="Search for courses">
                        </div>
                    </form>
                </div>
            </div>
            <div class="t-header-left">
                <div class="icons">
                    <div class="search-icon"></div>
                    <div class="menu-icon"></div>
                </div>
                @auth()
                    <div class="user-menu-account">
                        <div class="user-image">
                            <img src="{{auth()->user()->thumb}}" alt="{{auth()->user()->name}}">
                        </div>
                        <span>My Profile</span>
                        <div class="user-menu-account-dropdown">
                            <ul>
                                <li><a href="{{route('dashboard.users.profile')}}">View Profile</a></li>
                                <li><a href="{{route('dashboard.myShop.index')}}">My Purchases</a></li>
                                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('dashboard.users.logout')}}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                @endauth
                @guest()
                    <div class="login-register-btn ">
                        <div><a class="btn-login" href="{{route('login')}}">Login</a></div>
                        <div><a class="btn-register" href="{{route('login')}}">Register</a></div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    <nav id="navigation" class="navigation">
        <div class="after-login d-none">
            <a href="{{route('dashboard.users.profile')}}">View Profile</a>
            <a href="">My Purchases</a>
            <a href="{{route('dashboard')}}">Dashboard</a>
            <a href="{{route('dashboard.users.logout')}}">Logout</a>
        </div>
        <div class="login-register-btn d-none">
            <div><a class="btn-login" href="{{route('login')}}">Login</a></div>
            <div><a class="btn-register" href="{{route('register')}}">Register</a></div>
        </div>
        <div class="container">
            <ul class="nav">
                @foreach($categories as $category)
                    <li class="main-menu {{count($category->subCategory) ? 'has-sub' : ''}}"><a href="{{$category->path()}}">{{$category->title}}</a>
                        @if(count($category->subCategory))
                            <div class="sub-menu">
                                <div class="container">
                                    @foreach($category->subCategory as $subCategory)
                                        <div><a href="{{$subCategory->path()}}">{{$subCategory->title}}</a></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
