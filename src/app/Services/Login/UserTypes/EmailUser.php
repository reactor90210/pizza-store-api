<?php

namespace App\Services\Login\UserTypes;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Login\Interfaces\User;

class EmailUser implements User
{

    public function __construct(protected UserRepositoryInterface $userRepository)
    {

    }
    public function get($user)
    {
        return $this->userRepository->getUserByEmail($user['email']);
    }
}
