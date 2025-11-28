<?php

namespace Modules\Payment\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;

class SattlementPolicy
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
        if ($user->hasAnyPermission([Permission::PERMISSION_MANAGEMENT , Permission::PERMISSION_TEACHER]))
            return true;

        return null;
    }
    public function rejectAndAccept($user)
    {
        if ($user->hasAnyPermission([Permission::PERMISSION_MANAGEMENT]))
            return true;

        return null;
    }

}
