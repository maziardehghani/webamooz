<?php

namespace Modules\Payment\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class PaymentsPolicy
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
    public function manage(User $user)
    {
        if ($user->hasAnyPermission([Permission::PERMISSION_MANAGEMENT])) return true;
    }
}
