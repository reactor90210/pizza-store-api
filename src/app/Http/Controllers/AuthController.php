<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Services\Login\LoginService;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;

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

    public function postLogout() : JsonResponse
    {
        auth()->logout();
        return response()->json(['success'=>true]);
    }
}
