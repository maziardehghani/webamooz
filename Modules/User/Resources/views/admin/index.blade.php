@extends('dashboard::layouts.master')

@section('breadcrumb')
    <li><a href="{{route('dashboard.users')}}" title="Users">Users</a></li>
@endsection

@section('content')
    @if(session()->has('feedback'))
        <p class="h2">{{ session()->get('feedback')['title'] }}</p>
        <p>{{ session()->get('feedback')['body'] }}</p>
    @endif

    <div class="main-content padding-0 users">
        <div class="row no-gutters">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                <p class="box__title">Users</p>

                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>IP</th>
                            <th>User Roles</th>
                            <th>Assign Role</th>
                            <th>Delete</th>
                            <th>Email Verification</th>
                            <th>Edit</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr role="row">
                                <td><a href="">{{$user->id}}</a></td>
                                <td><a href="">{{$user->name}}</a></td>
                                <td><a href="">{{$user->email}}</a></td>
                                <td><a href="">{{$user->mobile}}</a></td>
                                <td><a href="">{{$user->ip}}</a></td>

                                <td>
                                    <ul>
                                        @foreach($user->permissions as $userPermission)
                                            <li>
                                                @lang($userPermission->name)
                                                <a href="{{route('dashboard.users.removePermission', [$userPermission->id, $user->id])}}"
                                                   class="item-delete mlg-15"
                                                   title="Remove">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td>
                                    <div class="col-12 bg-white">
                                        <form action="{{route('dashboard.users.addPermission', $user->id)}}" method="post" class="padding-30">
                                            @csrf
                                            <select name="permission">
                                                <option>-</option>
                                                @foreach($permissions as $permission)
                                                    <option value="{{ $permission->name }}">
                                                        @lang($permission->name)
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-webamooz_net">Add</button>
                                        </form>
                                    </div>
                                </td>

                                <td>
                                    <form id="destroyFrm" action="{{route('dashboard.users.destroy', $user->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="item-delete mlg-15" title="Delete"></button>
                                    </form>
                                </td>

                                <td>
                                    <form action="{{route('dashboard.users.verifyEmail', $user->id)}}" method="post">
                                        @csrf
                                        @method('patch')
                                        <p>{{ $user->hasVerifiedEmail() ? 'Verified' : 'Not Verified' }}</p>
                                        <button class="item-confirm mlg-15" title="Verify"></button>
                                    </form>
                                </td>

                                <td>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="View"></a>
                                    <a href="{{route('dashboard.users.edit', $user->id)}}" class="item-edit" title="Edit"></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
