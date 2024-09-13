<?php

namespace App\Services\Login;

use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class LoginService
{
    public function __construct(protected UserFactory $userFactory) {

    }

    public function OAuthLogin(string $provider): string
    {
        $oAuthUser = Socialite::driver($provider)->stateless()->user();
        $factory = $this->userFactory->create($provider);

        return auth()->login($factory->get($provider, $oAuthUser));
    }

    public function credentialsLogin(array $credentials) : string | ValidationException
    {
        $factory = $this->userFactory->create('email');

        $user = $factory->get($credentials);
        if(empty($user)){
            throw ValidationException::withMessages([
                'email' => ['Email address does not match.'],
            ]);
        }
        $token = auth()->attempt($credentials);
        if(!$token){
            throw ValidationException::withMessages([
                'password' => ['Invalid password.'],
            ]);
        }

        return $token;
    }
}
