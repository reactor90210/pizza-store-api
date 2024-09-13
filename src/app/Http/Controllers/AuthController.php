<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Services\Login\LoginService;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\UserService;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\ResponseResource;

class AuthController extends Controller
{

    public function getProviderRedirect(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function getProviderCallback(string $provider, LoginService $loginService) : LoginResource
    {
        $token = $loginService->OAuthLogin($provider);
        return new LoginResource($token);
    }

    public function postLogin(LoginRequest $request, LoginService $loginService) : LoginResource
    {
        $token = $loginService->credentialsLogin($request->only('email', 'password'));

        return new LoginResource($token);
    }

    public function postLogout() : ResponseResource
    {
        auth()->logout();
        return new ResponseResource(true);
    }

    public function postRegistration(RegistrationRequest $request, UserService $service): UserResource
    {
        return new UserResource($service->registration($request->all()));
    }
}
