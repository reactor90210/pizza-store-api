<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Services\Login\LoginService;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\UserService;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\Api\ApiResponse;

class AuthController extends Controller
{

    public function getProviderRedirect(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function getProviderCallback(string $provider, LoginService $loginService) : ApiResponse
    {
        $token = $loginService->OAuthLogin($provider);
        return new ApiResponse(new LoginResource($token));
    }

    public function postLogin(LoginRequest $request, LoginService $loginService) : ApiResponse
    {
        $token = $loginService->credentialsLogin($request->only('email', 'password'));

        return new ApiResponse(new LoginResource($token));
    }

    public function postLogout() : ApiResponse
    {
        auth()->logout();
        return new ApiResponse(true);
    }

    public function postRegistration(RegistrationRequest $request, UserService $service): ApiResponse
    {
        return new ApiResponse(new UserResource($service->registration($request->all())));
    }
}
