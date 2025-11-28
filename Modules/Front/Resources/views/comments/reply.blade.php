<div id="Modal2" class="modal">
    <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
            <p>Send Reply</p>
            <div class="close">×</div>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('comment.store') }}">
                @csrf
                <input name="commentable_id" type="text" value="{{ $commentable->id }}" hidden>
                <input name="commentable_type" type="text" value="{{ get_class($commentable) }}" hidden>
                <input name="comment_id" id="ThisComment_id" type="text" value="" hidden>

                <textarea name="body" class="txt hi-220px" placeholder="Write your reply here"></textarea>
                <button type="submit" class="btn i-t">Submit Reply</button>
            </form>
        </div>
    </div>
</div>
