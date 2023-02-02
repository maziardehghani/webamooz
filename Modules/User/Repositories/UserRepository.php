<?php

namespace Modules\User\Repositories;

use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use function PHPUnit\Framework\isNull;

class UserRepository
{
    public function findByEmail($email)
    {
        return User::query()->where('email' , $email)->first();
    }
    public function findByID($id)
    {
        return User::findOrFail($id);
    }
    public function getTeachers()
    {
       return User::permission(Permission::PERMISSION_TEACHER)->get();
    }
    public function paginate()
    {
        return User::paginate();
    }
    public function update($id , $value)
    {
        $updateData = [
            'name' => $value->name,
            'email' => $value->email,
            'username' => $value->username,
            'mobile' => $value->mobile,
            'status' => $value->status,
        ];
        if (! isNull($value->password))
        {
            $updateData['password'] = bcrypt($value->password);
        }
        User::where('id' , $id)->update($updateData);
    }

    public function updateProfile($request)
    {
        $user = (new UserRepository())->findByID(auth()->id());
        $user->name = $request->name;
        $user->telegram = $request->telegram;
        $user->mobile = $request->mobile;
        if ($user->email != $request->email)
        {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }
        if ($user->hasPermissionTo(Permission::PERMISSION_TEACHER))
        {
            $user->cardNumber = $request->cardNumber;
            $user->shaba = $request->shaba;
            $user->username = $request->username;
        }
        if ($request->password)
        {
            $user->password = bcrypt($request->password);
        }
        $user->save();
    }

    public function addPermission($value , $user)
    {
        $user->givePermissionTo($value->permission);
    }

    public function findByuserName($username)
    {
        return User::Permission(Permission::PERMISSION_TEACHER)->where('username' , $username)->first();

    }
}
