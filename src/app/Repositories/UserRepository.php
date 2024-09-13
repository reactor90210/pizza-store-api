<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function firstOrCreate(int $dbProvider, array $user) : User
    {
        return User::firstOrCreate($user);
    }

    public function getUserByEmail($email): User|null
    {
        return User::where('email', $email)->first();
    }

    public function createUser($user):User
    {
        return User::create($user);
    }

    public function updateUser($user): int
    {
        return auth()->user()->update($user);
    }
}
