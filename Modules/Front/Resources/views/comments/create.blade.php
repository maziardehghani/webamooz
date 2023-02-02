<div class="comment-main">
    <div class="ct-header">
        <h3>نظرات ( {{count($course->comments)}} )</h3>
        <p>نظر خود را در مورد این مقاله مطرح کنید</p>
    </div>
    <form action="{{route('comment.store')}}" method="post">
        @csrf
        <input name="commentable_id" type="text" value="{{$course->id}}" hidden>
        <input name="commentable_type" type="text" value="{{ get_class($course) }}" hidden>
        <div class="ct-row">
            <div class="ct-textarea">
                <textarea name="body" class="txt ct-textarea-field"></textarea>
            </div>
        </div>
        <div class="ct-row">
            <div class="send-comment">
                <button class="btn i-t">ثبت نظر</button>
            </div>
        </div>

    </form>
</div>
