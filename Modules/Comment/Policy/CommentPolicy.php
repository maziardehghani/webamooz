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
    public function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_TEACHER)? true : null;
    }
    public function manage($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)? true : null;
    }
    public function answer($user , $comment)
    {
        return
            $user->hasPermissionTo(Permission::PERMISSION_TEACHER)
            && $user->id == $comment->commentable->teacher_id ? true : null;
    }
}
