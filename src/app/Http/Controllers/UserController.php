<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Http\Resources\Api\ApiResponse;

class UserController extends Controller
{
    public function getUser() : ApiResponse
    {
        return new ApiResponse(new UserResource(auth()->user()));
    }

    public function postUpdateUser(UpdateUserRequest $request, UserService $userService) : ApiResponse
    {
        return new ApiResponse((bool)$userService->update($request->all()));
    }
}
