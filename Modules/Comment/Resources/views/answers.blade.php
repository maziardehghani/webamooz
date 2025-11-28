@extends('dashboard::layouts.master')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.comments') }}" title="Comments">Comments</a></li>
    <li><a href="" class="is-active">View Comment</a></li>
@endsection

@section('content')
<div class="show-comment">
    <div class="ct__header">
        <div class="comment-info">
            <a class="back" href="comments.html"></a>
            <div>
                <p class="comment-name"><a href="">{{ $comment->commentable->title }}</a></p>
            </div>
        </div>
    </div>

    <div class="transition-comment">
        <div class="transition-comment-header">
            <span>
                <img src="{{ $comment->user->thumb }}" class="logo-pic">
            </span>
            <span class="nav-comment-status">
                <p class="username">
                    {{ $comment->commentable->teacher_id == $comment->user->id ? 'Teacher' : 'User' }} : {{ $comment->user->name }}
                </p>
                <p class="comment-date">{{ verta($comment->created_at)->formatDifference() }}</p>
            </span>
            <div></div>
        </div>
        <div class="transition-comment-header">
            <p>{{ $comment->body }}</p>
            <div></div>
        </div>
    </div>

    @foreach($comment->answers as $answer)
    <div class="transition-comment is-answer">
        <div class="transition-comment-header">
            <span>
                <img src="{{ $answer->user->thumb }}" alt="" class="logo-pic">
            </span>
            <span class="nav-comment-status">
                <p class="username">
                    {{ $answer->commentable->teacher_id == $answer->user->id ? 'Teacher' : 'User' }} : {{ $answer->user->name }}
                </p>
                <p class="comment-date">{{ verta($answer->created_at)->formatDifference() }}</p>
            </span>
        </div>
        <div class="transition-comment-header">
            <p>{{ $answer->body }}</p>
            <div>
                <a href="{{ route('dashboard.comments.delete', $answer->id) }}" class="item-delete mlg-15" title="Delete"></a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="answer-comment">
    @if($comment->status == \Modules\Comment\Models\Comment::STATUS_ACCEPTED)
        <p class="p-answer-comment">Send a Reply</p>
        <form action="{{ route('comment.store') }}" method="post">
            @csrf
            <input name="comment_id" type="text" value="{{ $comment->id }}" hidden>
            <input name="commentable_id" type="text" value="{{ $comment->commentable->id }}" hidden>
            <input name="commentable_type" type="text" value="{{ get_class($comment->commentable) }}" hidden>
            <textarea name="body" class="textarea" placeholder="Reply to this comment"></textarea>
            <button class="btn btn-webamooz_net">Send Reply</button>
        </form>
    @else
        <p class="p-answer-comment text-error">This comment has not been approved</p>
    @endif
</div>
@endsection
