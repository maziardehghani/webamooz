<?php

namespace Modules\RolePermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Role extends \Spatie\Permission\Models\Role
{

    use HasFactory , HasRoles;

}
