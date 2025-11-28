<?php

namespace Modules\RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\RolePermissions\Http\Requests\RoleRequest;
use Modules\RolePermissions\Http\Requests\RoleUpdateRequest;
use Modules\RolePermissions\Models\Role;
use Modules\RolePermissions\Repository\PermissionRepository;
use Modules\RolePermissions\Repository\RoleRepository;

class RolePermissionsController extends Controller
{
    private $roleRepository;
    private $permissionRepository;
    public function __construct(RoleRepository $roleRepository , PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $this->authorize('index' , Role::class);
        $permissions = $this->permissionRepository->all();
        $roles = $this->roleRepository->all();

        return view('rolepermissions::index' , compact('permissions' , 'roles'));
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('store' , Role::class);

        $this->roleRepository->store($request);

        return redirect(route('dashboard.Role_permissions'));
    }

    public function edit($role)
    {

        $this->authorize('edit' , Role::class);
        $role = $this->roleRepository->findById($role);
        $permissions = $this->permissionRepository->all();

        return view('rolepermissions::layouts.edit' , compact('permissions' , 'role'));
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        $this->authorize('edit' , Role::class);
        $this->roleRepository->update($request , $id);
        return redirect(route('dashboard.Role_permissions'));
    }

    public function destroy($roleID)
    {
        $this->authorize('delete' , Role::class);

        $this->roleRepository->delete($roleID);
        return redirect(route('dashboard.Role_permissions'));
    }
}
