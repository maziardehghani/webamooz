@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.comments')}}" title="نظرات">نظرات</a></li>
    <li><a href="" class="is-active"> مشاهده نظر</a></li>

@endsection
@section('content')
    <div class="show-comment">
        <div class="ct__header">
            <div class="comment-info">
                <a class="back" href="comments.html"></a>
                <div>
                    <p class="comment-name"><a href="">{{$comment->commentable->title}}</a></p>
                </div>
            </div>
        </div>
        <div class="transition-comment">
            <div class="transition-comment-header">
                       <span>
                            <img src="{{$comment->user->thumb}}" class="logo-pic">
                       </span>
                <span class="nav-comment-status">
                            <p class="username">{{$comment->commentable->teacher_id == $comment->user->id ? 'مدرس' : 'کاربر'}} : {{$comment->user->name}}</p>
                            <p class="comment-date">{{verta($comment->created_at)->formatDifference()}}</p></span>
                <div>

                </div>
            </div>
            <div class="transition-comment-header">
                <p>{{$comment->body}}</p>
                <div>

                </div>
            </div>
        </div>
        @foreach($comment->answers as $answer)
            <div class="transition-comment is-answer">
                <div class="transition-comment-header">
                 <span>
                     <img src="{{$answer->user->thumb}}" alt="" class="logo-pic">
                 </span>
                    <span class="nav-comment-status">
                        <p class="username">{{$answer->commentable->teacher_id == $answer->user->id ? 'مدرس' : 'کاربر'}} : {{$answer->user->name}}</p>
                        <p class="comment-date">{{verta($answer->created_at)->formatDifference()}}</p></span>
                    </span>
                </div>
                <div class="transition-comment-header">
                    <p>
                        {{$answer->body}}
                    </p>

                    <div>
                        <a href="{{route('dashboard.comments.delete' , $answer->id)}}" class="item-delete mlg-15" title="حذف"></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

        <div class="answer-comment">
            @if($comment->status == \Modules\Comment\Models\Comment::STATUS_ACCEPTED)
            <p class="p-answer-comment">ارسال پاسخ</p>
        <form action="{{route('comment.store')}}" method="post">
            @csrf
            <input name="comment_id" type="text" value="{{$comment->id}}" hidden>
            <input name="commentable_id" type="text" value="{{$comment->commentable->id}}" hidden>
            <input name="commentable_type" type="text" value="{{ get_class($comment->commentable) }}" hidden>
            <textarea name="body" class="textarea" placeholder="متن پاسخ نظر"></textarea>
            <button class="btn btn-webamooz_net">ارسال پاسخ</button>
        </form>
            @else
                <p class="p-answer-comment text-error">این نظر تایید نشده است</p>
            @endif
    </div>
@endsection
