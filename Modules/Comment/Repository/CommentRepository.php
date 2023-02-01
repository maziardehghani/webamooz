<?php

namespace Modules\Comment\Repository;

use Modules\Comment\Models\Comment;
use Modules\Course\Models\courses;
use Modules\RolePermissions\Models\Permission;

class CommentRepository
{
    public function store($value)
    {
        return Comment::query()->create([
            'user_id' => auth()->id(),
            'comment_id' => array_key_exists('comment_id', $value) ? $value['comment_id'] : null,
            'commentable_id' => $value['commentable_id'],
            'commentable_type' => $value['commentable_type'],
            'body' => $value['body'],
            'status' => auth()->user()->hasAnyPermission([Permission::PERMISSION_TEACHER , Permission::PERMISSION_MANAGEMENT])?
                Comment::STATUS_ACCEPTED
                    :
                Comment::STATUS_NEW,
        ]);
    }
    public function findAccepted($id)
    {
        return Comment::query()->where('status' , Comment::STATUS_ACCEPTED)
            ->where('id' , $id)
            ->first();
    }

    public function getComments($status = null , $teacher_id = null)
    {
        $query = Comment::query()->whereNull('comment_id');
        if (!is_null($status))
        {
            $query->where('status' , $status);
        }
        if (!is_null($teacher_id))
        {
            $query->whereHasMorph("commentable" , courses::class , function ($query)
            {
                 $query->where('teacher_id' , auth()->id());
            });
        }
            return $query->latest()->paginate();
    }

    public function changeStatus($comment, $status)
    {
        return $comment->update([
            'status' => $status
        ]);
    }
    public function find($id)
    {
        return Comment::query()->findOrFail($id);
    }

    public function findComment($id)
    {
        return Comment::query()->where('id' , $id)
            ->with(['commentable' , 'user' , 'answers'] )
            ->firstOrFail();
    }

}
