<?php

namespace App\Services\Login\UserTypes;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Login\Interfaces\OAuthUser;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class GithubUser implements OAuthUser
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {

    }

    public function get($provider, $user)
    {
        $dbProvider = Config::get("services.$provider.database_id");

        $userArray = [
            'provider'=> $dbProvider,
            'provider_id'=> strval($user->user['id']),
            'avatar'=> $user->user['avatar_url'],
            'name'=> $user->user['login'],
        ];

       return $this->userRepository->firstOrCreate($dbProvider, $userArray);
    }
}
