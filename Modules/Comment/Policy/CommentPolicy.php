<?php

namespace Modules\Comment\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Comment\Models\Comment;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function manage($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_TEACHER))
        {
            return true;
        }
        return null;
    }
    public function show($user , $comment)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_TEACHER) &&
            $user->id == $comment->commentable->teacher_id)
        {
            return true;
        }
        return null;
    }
}
