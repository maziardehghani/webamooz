<div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
    <div class="header__right d-flex flex-grow-1 item-center">
        <span class="bars"></span>
        <a class="header__logo" href="https://webamooz.net"></a>
    </div>
    <div class="header__left d-flex flex-end item-center margin-top-2">
        <span class="account-balance font-size-12">موجودی : {{auth()->user()->balance}} تومان</span>
        <div class="notification margin-15">
            <a onclick="notifMarkAsReed()" class="notification__icon @if(count($notifications)) text-error @endif "> @if(count($notifications)) <span class="text-error font-size-13">{{count($notifications)}}</span> @endif</a>
            <div  class="dropdown__notification">
                <div class="content__notification">
                    @if(count($notifications))
                        <ul>
                        @foreach($notifications as $notification)
                                    <li class="font-size-13">
                                        <a href="{{$notification->data['url']}}">
                                                    {{$notification->data['message']}} !
                                            ({{verta($notification->created_at)->formatDifference()}})
                                        </a>
                                    </li>
                        @endforeach
                        </ul>
                        @else
                        <span class="font-size-13">موردی برای نمایش وجود ندارد</span>
                    @endif
                </div>
            </div>
        </div>
        <a href="{{route('dashboard.users.logout')}}" class="logout" title="خروج"></a>
    </div>
</div>

<script>
    function notifMarkAsReed() {

        var url = 'http://127.0.0.1:8000/notification/markAsReed';
        var data = {};
        $.get(url, data, function (msg) {

        });

    }
</script>
