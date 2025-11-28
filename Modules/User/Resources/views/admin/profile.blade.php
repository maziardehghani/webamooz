@extends('dashboard::layouts.master')

@section('breadcrumb')
    <li><a href="{{route('dashboard.users')}}" title="User Information">User Information</a></li>
    <li><a href="#" title="Edit Profile">Edit Profile</a></li>
@endsection

@section('content')
<div class="col-12 bg-white">
    <p class="box__title">Edit Profile</p>

    <form action="{{route('dashboard.users.profile.update', auth()->user()->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
        @csrf

        <input name="name" required type="text" class="text" value="{{auth()->user()->name}}" placeholder="Full Name">
        @error('name')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="email" required type="text" class="text" value="{{auth()->user()->email}}" placeholder="Email Address">
        @error('email')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="username" type="text" class="text" value="{{auth()->user()->username}}" placeholder="Username">
        @error('username')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="mobile" type="text" class="text" value="{{auth()->user()->mobile}}" placeholder="Mobile Number">
        @error('mobile')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="telegram" type="text" class="text" value="{{auth()->user()->telegram}}" placeholder="Telegram ID for Notifications">
        @error('telegram')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="cardNumber" type="text" class="text" value="{{auth()->user()->cardNumber}}" placeholder="Bank Card Number">
        @error('cardNumber')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="shaba" type="text" class="text" value="{{auth()->user()->shaba}}" placeholder="IBAN Number">
        @error('shaba')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="profileAddress" type="text" class="text" placeholder="Profile Username / Address">
        @error('profileAddress')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input class="text" name="new-password" placeholder="New Password" value="">
        @error('new-password')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        @can(\Modules\RolePermissions\Models\Permission::PERMISSION_TEACHER)
            <textarea class="text" placeholder="About Me (Teachers Only)"></textarea>
        @endcan

        <button class="btn btn-webamooz_net">Update</button>
    </form>
</div>
@endsection
