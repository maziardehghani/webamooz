@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.Role_permissions')}}" title="User Roles">User Roles</a></li>
@endsection
@section('content')

    <div class="main-content padding-0 categories">
        <div class="row no-gutters">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">Users</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>ID</th>
                            <th>User Role</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)

                            <tr role="row" class="">
                                <td><a href="">{{$loop->iteration}}</a></td>
                                <td><a href="">@lang($role->name)</a></td>
                                <td>
                                    @foreach($role->permissions as $permission)
                                        <li>@lang($permission->name)</li>
                                    @endforeach
                                </td>
                                <td>
                                    <form id="destroyFrm" action="{{route('dashboard.Role_permissions.destroy', $role->id) }}" method="post">
                                        @method('DELETE')  @csrf
                                        <button type="submit" class="item-delete mlg-15" title="Delete"></button>
                                        <a href="" target="_blank" class="item-eye mlg-15" title="View"></a>
                                        <a href="{{route('dashboard.Role_permissions.edit' , $role->id)}}" class="item-edit" title="Edit"></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    @include('rolepermissions::layouts.create')
@endsection
