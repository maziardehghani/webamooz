<div id="Modal2" class="modal">
    <div class="modal-content" style="width: 1000px;">
        <div class="modal-header">
            <p>ارسال پاسخ</p>
            <div class="close">×</div>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('comment.store')}}">
                @csrf
                <input name="commentable_id" type="text" value="{{$commentable->id}}" hidden>
                <input name="commentable_type" type="text" value="{{ get_class($commentable) }}" hidden>
                <input name="comment_id" id="ThisComment_id" type="text" value="" hidden>

                <textarea name="body" class="txt hi-220px" placeholder="متن دیدگاه"></textarea>
                <button type="submit" class="btn i-t">ثبت پاسخ</button>
            </form>
        </div>

    </div>
</div>
