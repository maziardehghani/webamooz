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
       return User::permission(Permission::PERMISSION_TEACH)->get();
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
            'headline' => $value->headline,
            'bio' => $value->bio,
            'status' => $value->status,
            'telegram' => $value->telegram,
            'whatsapp' => $value->whatsapp,
            'linkedin' => $value->linkedin,
            'facebook' => $value->facebook,
            'image_id' => $value->image_id,
        ];
        if (! isNull($value->password))
        {
            $updateData['password'] = bcrypt($value->password);
        }
        User::where('id' , $id)->update($updateData);
    }

    public function updateProfile($request)
    {
        auth()->user()->name = $request->name;
        if (auth()->user()->email != $request->email)
        {
            auth()->user()->email = $request->email;
            auth()->user()->email_verified_at = null;
        }
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACH))
        {
            auth()->user()->cardNumber = $request->cardNumber;
            auth()->user()->shaba = $request->shaba;
            auth()->user()->username = $request->username;
        }
        if ($request->password)
        {
            auth()->user()->password = bcrypt($request->password);
        }
        auth()->user()->save();
    }

    public function addPermission($value , $user)
    {
        $user->givePermissionTo($value->permission);
    }
}
