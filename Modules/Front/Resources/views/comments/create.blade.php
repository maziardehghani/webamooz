<div class="comment-main">
    <div class="ct-header">
        <h3>Comments ({{ count($course->comments) }})</h3>
        <p>Share your thoughts about this course</p>
    </div>

    <form action="{{ route('comment.store') }}" method="post">
        @csrf
        <input name="commentable_id" type="text" value="{{ $course->id }}" hidden>
        <input name="commentable_type" type="text" value="{{ get_class($course) }}" hidden>

        <div class="ct-row">
            <div class="ct-textarea">
                <textarea name="body" class="txt ct-textarea-field" placeholder="Write your comment here"></textarea>
            </div>
        </div>

        <div class="ct-row">
            <div class="send-comment">
                <button class="btn i-t">Submit Comment</button>
            </div>
        </div>

    </form>
</div>
