<div class="container">
    <div class="comments">
        @include('front::comments.create')
        <div class="comments-list">
            @include('front::comments.reply' , ['commentable' => $commentable])
            @foreach($commentable->AcceptedComments as $comment)
            <ul class="comment-list-ul">
                <div class="div-btn-answer">
                    @if($commentable->teacher_id == auth()->id() )
                    <a onclick="setCommentsId({{$comment->id}})" class="btn-answer">پاسخ به دیدگاه</a>
                    @endif
                </div>
                <li class="is-comment">
                    <div class="comment-header">
                        <div class="comment-header-avatar">
                            <img src="{{$comment->user->thumb}}">
                        </div>
                        <div class="comment-header-detail">
                            <div class="comment-header-name">{{$commentable->teacher_id == $comment->user->id ? 'مدرس' : 'کاربر'}} : {{$comment->user->name}}</div>
                            <div class="comment-header-date">{{verta($comment->created_at)->formatDifference()}}</div>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>
                            {{$comment->body}}
                        </p>
                    </div>
                </li>

                @foreach($comment->answers as $answer)
                <li class="is-answer">
                    <div class="comment-header">
                        <div class="comment-header-avatar">
                            <img src="{{$answer->user->thumb}}">
                        </div>
                        <div class="comment-header-detail">
                            <div class="comment-header-name">{{$commentable->teacher_id == $comment->user->id ? 'مدرس' : 'کاربر'}} : {{$answer->user->name}}</div>
                            <div class="comment-header-date">{{verta($answer->created_at)->formatDifference()}}</div>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>
                            {{$answer->body}}
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>
            @endforeach
        </div>
    </div>
</div>
<script>

</script>
