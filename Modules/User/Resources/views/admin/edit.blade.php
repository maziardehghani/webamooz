@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.users')}}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربران">ویرایش کاربران</a></li>
@endsection
@section('content')
<div class="col-12 bg-white">
    <p class="box__title">ویرایش کاربر</p>
    <form action="{{route('dashboard.users.update',$user->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input name="name" required type="text"  class="text" value="{{$user->name}}">
        @error('name')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="email" required type="text"  class="text" value="{{$user->email}}">
        @error('email')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="username"  type="text"  class="text" value="{{$user->username}}">
        @error('username')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input name="mobile"  type="text"  class="text" value="{{$user->mobile}}">
        @error('mobile')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <select name="status" >
            <option value="">وضعیت کاربر</option>

            @foreach(\Modules\User\Models\User::$statuses as $status)
                <option value="{{$status}}" {{$status == $user->status ? 'selected' : ''}}>@lang($status)</option>
            @endforeach
        </select>
        @error('status')
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

        <button class="btn btn-webamooz_net">ویرایش</button>
    </form>
</div>
@endsection
