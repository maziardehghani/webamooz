@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.courses')}}" title="Courses">Courses</a></li>
@endsection
@section('content')

    <div class="main-content padding-0 courses">
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">Courses</p>
                <a href="{{route('dashboard.courses.create')}}">Create New Course</a>

                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th></th>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Instructor Name</th>
                            <th>Price</th>
                            <th>Details</th>
                            <th>Instructor Percentage</th>
                            <th>Status</th>
                            <th>Confirmation Status</th>
                            @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Approve</th>
                                <th>Reject</th>
                                <th>Lock</th>
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
                                <td><a href="{{route('dashboard.courses.details' , $course->id)}}">View</a></td>
                                <td>{{$course->percent}}</td>
                                <td>@lang($course->status)</td>
                                <td>@lang($course->confirmation_status)</td>

                                @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)
                                    <td>
                                        <form id="destroyFrm" action="{{route('dashboard.courses.destroy', $course->id) }}" method="post">
                                            @method('DELETE')  @csrf
                                            <button type="submit" class="item-delete mlg-15" title="Delete"></button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="" target="_blank" class="item-eye mlg-15" title="View"></a>
                                        <a href="{{route('dashboard.courses.edit' , $course->id)}}" class="item-edit " title="Edit"></a>
                                    </td>
                                    <td>
                                        <form  action="{{route('dashboard.courses.accept', $course->id) }}" method="post">
                                            @csrf @method('patch')
                                            <button class="item-confirm mlg-15" title="Approve"></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form  action="{{route('dashboard.courses.reject', $course->id) }}" method="post">
                                            @csrf @method('patch')
                                            <button class="item-reject mlg-15" title="Reject"></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form  action="{{route('dashboard.courses.locked', $course->id) }}" method="post">
                                            @csrf @method('patch')
                                            <button class="item-lock mlg-15" title="Lock"></button>
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
