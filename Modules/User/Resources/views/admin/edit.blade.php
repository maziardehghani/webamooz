@extends('dashboard::layouts.master')

@section('breadcrumb')
    <li><a href="{{route('dashboard.users')}}" title="Users">Users</a></li>
    <li><a href="#" title="Edit User">Edit User</a></li>
@endsection

@section('content')
<div class="col-12 bg-white">
    <p class="box__title">Edit User</p>

    <form action="{{route('dashboard.users.update',$user->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input name="name" required type="text" class="text" value="{{$user->name}}" placeholder="Name">
        @error('name')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="email" required type="text" class="text" value="{{$user->email}}" placeholder="Email">
        @error('email')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="username" type="text" class="text" value="{{$user->username}}" placeholder="Username">
        @error('username')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="mobile" type="text" class="text" value="{{$user->mobile}}" placeholder="Mobile">
        @error('mobile')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <select name="status">
            <option value="">User Status</option>

            @foreach(\Modules\User\Models\User::$statuses as $status)
                <option value="{{$status}}" {{$status == $user->status ? 'selected' : ''}}>
                    @lang($status)
                </option>
            @endforeach
        </select>

        @error('status')
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

        <button class="btn btn-webamooz_net">Update</button>
    </form>
</div>
@endsection
