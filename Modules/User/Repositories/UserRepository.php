<?php

namespace Modules\User\Repositories;

use Modules\User\Models\User;

class UserRepository
{
    public function findByEmail($email)
    {
        return User::query()->where('email' , $email)->first();
    }
}
