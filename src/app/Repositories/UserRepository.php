<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    public function firstOrCreate(int $dbProvider, array $user)
    {
        return User::firstOrCreate($user);
    }

    public function getUserByEmail($email){
        return User::where('email', $email)->first();
    }
}
