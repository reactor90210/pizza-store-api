<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function firstOrCreate(int $dbProvider, array $user);
    public function getUserByEmail(string $email);
    public function createUser(array $user);
    public function updateUser(array $user);
}
