<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://webamooz.net"></a>
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="panel/img/pro.jpg" class="avatar___img">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">کاربر : محمد نیکو</span>
    </div>

    <ul>
        @foreach(config('sidebar.item') as $item)
            <li class="item-li {{$item['icon']}} @if(request()->url() == $item['url']) is-active @endif" ><a href={{$item['url']}}>{{$item['title']}}</a></li>
        @endforeach

    </ul>

</div>
