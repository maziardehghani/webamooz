@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.users')}}" title="کاربران">کاربران</a></li>
@endsection
@section('content')
    @if(session()->has('feedback'))
        <p class="h2"> {{session()->get('feedback')['title']}} </p>
        <p> {{session()->get('feedback')['body']}} </p>
        @endif
    <div class="main-content padding-0 users">
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">کاربران</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>ردیف</th>
                            <th>ID</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>موبایل</th>
                            <th>IP</th>
                            <th>نقش کاربری</th>
                            <th>انتخاب نقش کاربری</th>
                            <th>حذف</th>
                            <th>تایید ایمیل</th>
                            <th>ویرایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)

                            <tr role="row" class="">
                                <td>{{$loop->iteration}}</td>
                                <td><a href="">{{$user->id}}</a></td>
                                <td><a href="">{{$user->name}}</a></td>
                                <td><a href="">{{$user->email}}</a></td>
                                <td><a href="">{{$user->mobile}}</a></td>
                                <td><a href="">{{$user->ip}}</a></td>
                                <td>
                                    <ul>
                                        @foreach($user->permissions as $userPermission)
                                        <li>
                                            @lang($userPermission->name)<a href="{{route('dashboard.users.removePermission' , [$userPermission->id , $user->id])}}" class="item-delete mlg-15"  title="حذف"> </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="col-12 bg-white">
                                        <form action="{{route('dashboard.users.addPermission' , $user->id)}}" method="post" class="padding-30">
                                         @csrf
                                           <select name="permission">
                                               <option>-</option>
                                           @foreach($permissions as $permission)
                                                <option value={{$permission->name}}>@lang($permission->name)</option>
                                               @endforeach
                                            </select>
                                            <button class="btn btn-webamooz_net">اضافه کردن</button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <form id="destroyFrm" action="{{route('dashboard.users.destroy', $user->id) }}" method="post">
                                        @method('DELETE')  @csrf
                                        <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                    </form>
                                </td>
                                <td>
                                    <form  action="{{route('dashboard.users.verifyEmail', $user->id) }}" method="post">
                                        @csrf @method('patch')
                                        <p>{{$user->hasVerifiedEmail() ? 'تایید شده' : 'تایید نشده'}}</p>
                                        <button class="item-confirm mlg-15" title="تایید"></button>
                                    </form>
                                </td>
                                <td>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{route('dashboard.users.edit' , $user->id)}}" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection

