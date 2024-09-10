<?php

namespace App\Services\Login\UserTypes;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Login\Interfaces\OAuthUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Config;

class GoogleUser implements OAuthUser
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {

    }

    public function get($provider, $user):Authenticatable
    {
        $dbProvider = Config::get("services.$provider.database_id");
        $userArray = [
            'provider'=> $dbProvider,
            'provider_id'=> strval($user->user['sub']),
            'avatar'=> $user->user['picture'],
            'name'=> $user->user['name']
        ];

        return $this->userRepository->firstOrCreate($dbProvider, $userArray);
    }
}
