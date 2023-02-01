<?php

namespace Modules\Comment\Traits;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Modules\Comment\Models\Comment;

trait HasComment
{

    use HasRelationships;

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }
    public function AcceptedComments()
    {
        return $this->morphMany(Comment::class , 'commentable')
            ->where('status' , Comment::STATUS_ACCEPTED)
            ->whereNull('comment_id');
    }

}
