<?php

namespace App\Services\Login;

use App\Services\Login\Interfaces\User;
use App\Services\Login\Interfaces\OAuthUser;
use App\Services\Login\UserTypes\GithubUser;
use App\Services\Login\UserTypes\GoogleUser;
use App\Services\Login\UserTypes\EmailUser;

class UserFactory
{
    public function __construct(protected GithubUser $githubUser, protected GoogleUser $googleUser, protected EmailUser $emailUser) {

    }

    public function create(string $provider): User|OAuthUser
    {
        return match($provider) {
            'email' => $this->emailUser,
            'github'  => $this->githubUser,
            'google'  => $this->googleUser,
            default => throw new \InvalidArgumentException("Can not create '{$provider}'")
        };
    }
}
