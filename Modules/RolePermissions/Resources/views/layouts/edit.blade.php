@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.Role_permissions')}}" title="نقش کاربری">نقش کاربری</a></li>
    <li><a href="#" title="ویرایش نقش کاربری">ویرایش نقش کاربری</a></li>
@endsection
@section('content')
<div class="col-4 bg-white">
    <p class="box__title">ویرایش نقش کاربری</p>
    <form action="{{route('dashboard.Role_permissions.update', $role->id)}}" method="post" class="padding-30">
        @csrf
        @method('PUT')
        <input name="name" required type="text" placeholder="نام کاربر" class="text" value="{{$role->name}}">
        @error('name')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <p class="box__title margin-bottom-15">انتخاب مجوز</p>
        @foreach($permissions as $permission)
            <label class="ui-checkbox pt-1">
                <input name="permissions[{{$permission->name}}]" type="checkbox" class="sub-checkbox"
                       data-id="1" value="{{$permission->name}}"
                       @if($role->hasPermissionTo($permission)) checked @endif
                >
                <span class="checkmark"></span>
                @lang($permission->name)
            </label>
        @endforeach
        @error('permissions')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <button class="btn btn-webamooz_net mt-2">ویرایش</button>
    </form>
</div>
@endsection
