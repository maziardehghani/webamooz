@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.courses')}}" title="دوره ها">دوره ها</a></li>
@endsection
@section('content')

    <div class="main-content padding-0 courses">
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دوره ها</p>
              <a href="{{route('dashboard.courses.create')}}">ایجاد دوره جدید</a>

                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th></th>
                            <th>ردیف</th>
                            <th>نام دوره</th>
                            <th>نام مدرس</th>
                            <th>قیمت</th>
                            <th>جزعیات</th>
                            <th>درصد مدرس</th>
                            <th>وضعیت</th>
                            <th>وضعیت تایید</th>
                            @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
                            <th>حذف</th>
                            <th>ویرایش</th>
                            <th>تایید</th>
                            <th>عدم تایید</th>
                            <th>قفل کردن</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)

                            <tr role="row" class="">
                                <td><img src="{{$course->banner?->thumb}}" width="80"></td>
                                <td><a href="">{{$course->priority}}</a></td>
                                <td><a href="">{{$course->title}}</a></td>
                                <td><a href="">{{$course->teacher?->name}}</a></td>
                                <td>{{$course->price}}</td>
                                <td><a href="{{route('dashboard.courses.details' , $course->id)}}">مشاهده</a></td>
                                <td>{{$course->percent}}</td>
                                <td>@lang($course->status)</td>
                                <td>@lang($course->confirmation_status)</td>

                                @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
                                <td>
                                    <form id="destroyFrm" action="{{route('dashboard.courses.destroy', $course->id) }}" method="post">
                                        @method('DELETE')  @csrf
                                        <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                    </form>
                                </td>
                                <td>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{route('dashboard.courses.edit' , $course->id)}}" class="item-edit " title="ویرایش"></a>
                                </td>
                                <td>
                                    <form  action="{{route('dashboard.courses.accept', $course->id) }}" method="post">
                                        @csrf @method('patch')
                                        <button class="item-confirm mlg-15" title="تایید"></button>
                                    </form>
                                </td>
                                <td>
                                    <form  action="{{route('dashboard.courses.reject', $course->id) }}" method="post">
                                        @csrf @method('patch')
                                        <button class="item-reject mlg-15" title="عدم تایید"></button>
                                    </form>
                                </td>
                                <td>
                                    <form  action="{{route('dashboard.courses.locked', $course->id) }}" method="post">
                                        @csrf @method('patch')
                                        <button class="item-lock mlg-15" title="عدم تایید"></button>
                                    </form>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection

