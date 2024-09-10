<?php

namespace App\Services\Login\Interfaces;

use Laravel\Socialite\Two\User;

interface OAuthUser
{
    public function get($provider, User $user);
}
