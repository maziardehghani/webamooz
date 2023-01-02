<div class="sidebar__nav border-top border-left  ">

<form action="{{route('dashboard.users.photo')}}" method="post" enctype="multipart/form-data">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://webamooz.net"></a>
    <div class="profile__info border cursor-pointer text-center">
            @csrf
            <div class="avatar__img"><img src="{{auth()->user()->image ? auth()->user()->image->thumb : ''}}" class="avatar___img">
                <input name="user_photo" type="file" accept="image/*" class="hidden avatar-img__input"
                       onchange="this.form.submit()">
                <div class="v-dialog__container" style="display: block;"></div>
                <div class="box__camera default__avatar"></div>
            </div>
        <span class="profile__name">کاربر : {{auth()->user()->name}}</span>
    </div>
</form>
    <ul>
        @foreach(config('sidebar.item') as $item)
            @if(!array_key_exists('permission' , $item) || auth()->user()->hasAnyPermission($item['permission']) || auth()->user()->hasPermissionTo(\Modules\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN))
            <li class="item-li {{$item['icon']}} @if(str_starts_with(request()->url() , $item['url'])) is-active @endif" ><a href={{$item['url']}}>{{$item['title']}}</a></li>
            @endif
        @endforeach
    </ul>

</div>
