<?php

namespace Modules\RolePermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Permission extends \Spatie\Permission\Models\Permission
{

    use HasFactory , HasRoles;



    const PERMISSION_SUPER_ADMIN= 'super_admin';
    const PERMISSION_TEACHER= 'teacher';
    const PERMISSION_MANAGEMENT= 'management';


    static $permissions = [
        self::PERMISSION_TEACHER,
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_MANAGEMENT
    ];

}
