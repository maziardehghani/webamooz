<?php

namespace Modules\RolePermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
class Permission extends \Spatie\Permission\Models\Permission
{

    use HasFactory , HasRoles;


    const PERMISSION_MANAGE_CATEGORIES='manage_categories';
    const PERMISSION_MANAGE_COURSES='manage_courses';
    const PERMISSION_MANAGE_USERS='manage_users';
    const PERMISSION_MANAGE_OWN_COURSES ='manage_own_courses';
    const PERMISSION_MANAGE_ROLE_PERMISSIONS='manage_RolePermissions';
    const PERMISSION_TEACH= 'teach';
    const PERMISSION_SUPER_ADMIN= 'super_admin';


    static $permissions = [
        self::PERMISSION_MANAGE_CATEGORIES ,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_TEACH,
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_MANAGE_OWN_COURSES,
        self::PERMISSION_MANAGE_USERS
    ];

}
