<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {

    }

    private function userData($requestArray) : array
    {
         $data = ['name' => $requestArray['name'],
                 'email' => $requestArray['email']];

        if(auth()->user()->provider === 1){
            $data['password'] = Hash::make($requestArray['password']);
        }

        return $data;
    }

    public function registration($requestArray) : User
    {
        return $this->userRepository->createUser($this->userData($requestArray));
    }

    public function update($requestArray) : int
    {
        return $this->userRepository->updateUser($this->userData($requestArray));
    }
}
