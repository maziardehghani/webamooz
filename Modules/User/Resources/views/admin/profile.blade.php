@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.users')}}" title="اطلاعات کاربری">اطلاعات کاربری</a></li>
    <li><a href="#" title="ویرایش پروفایل">ویرایش پروفایل</a></li>
@endsection
@section('content')
<div class="col-12 bg-white">
    <p class="box__title">ویرایش دسته بندی</p>
    <form action="{{route('dashboard.users.profile.update',auth()->user()->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
        @csrf
        <input name="name" required type="text"  class="text" value="{{auth()->user()->name}}">
        @error('name')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="email" required type="text"  class="text" value="{{auth()->user()->email}}">
        @error('email')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="username"  type="text"  class="text" value="{{auth()->user()->username}}" placeholder="نام کاربری">
        @error('username')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="mobile"  type="text"  class="text" value="{{auth()->user()->mobile}}">
        @error('mobile')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="cardNumber"  type="text"   class="text" value="{{auth()->user()->cardNumber}}" placeholder="شماره کارت بانکی">
        @error('cardNumber')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="shaba"  type="text"  class="text" value="{{auth()->user()->shaba}}" placeholder="شماره شبا بانکی">
        @error('shaba')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="profileAddress"  type="text"  class="text" placeholder="نام کاربری و آدرس پروفایل">
        @error('profileAddress')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input class="text"  name="new-password" placeholder="پسورد جدید"  value="">
        @error('new-password')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        @can(\Modules\RolePermissions\Models\Permission::PERMISSION_TEACHER)
        <textarea class="text" placeholder="درباره من مخصوص مدرسین"></textarea>
        @endcan
        <button class="btn btn-webamooz_net">بروزرسانی</button>
    </form>
</div>
@endsection
