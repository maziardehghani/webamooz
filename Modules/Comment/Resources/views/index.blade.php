@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.comments')}}" title="نظرات">نظرات</a></li>
@endsection
@section('content')
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{route('dashboard.comments')}}"> همه نظرات</a>
                <a class="tab__item is-active" href="{{route('dashboard.comments')}}?status=rejected">نظرات تاییده نشده</a>
                <a class="tab__item is-active" href="{{route('dashboard.comments')}}?status=accepted">نظرات تاییده شده</a>
                <a class="tab__item is-active" href="{{route('dashboard.comments')}}?status=new">نظرات جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی در نظرات">
                        <div class="t-header-search-content ">
                            <input type="text"  class="text"  placeholder="قسمتی از متن">
                            <input type="text"  class="text"  placeholder="ایمیل">
                            <input type="text"  class="text margin-bottom-20"  placeholder="نام و نام خانوادگی">
                            <btutton class="btn btn-webamooz_net">جستجو</btutton>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ارسال کننده</th>
                    <th>برای</th>
                    <th>دیدگاه</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                <tr role="row" >
                    <td><a href="">{{$loop->iteration}}</a></td>
                    <td><a href="">{{$comment->user->name}}</a></td>
                    <td><a href="{{$comment->commentable->path()}}">{{$comment->commentable->title}}</a></td>
                    <td>{{$comment->body}}</td>
                    <td>{{verta($comment->created_at)}}</td>
                    <td class="{{$comment->status == \Modules\Comment\Models\Comment::STATUS_ACCEPTED ? 'text-success':'text-error'}}">@lang($comment->status)</td>
                    <td>
                        <a href="{{route('dashboard.comments.delete' , $comment->id)}}" class="item-delete mlg-15" title="حذف"></a>
                        <a href="{{route('dashboard.comments.reject' , $comment->id)}}"  class="item-reject mlg-15" title="رد"></a>
                        <a href="{{route('dashboard.comments.answers' , $comment->id)}}" class="item-eye mlg-15" title="مشاهده"></a>
                        <a href="{{route('dashboard.comments.accept' , $comment->id)}}"  class="item-confirm mlg-15" title="تایید"></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
