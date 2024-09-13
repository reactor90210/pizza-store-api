<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\ResponseResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function getUser() : UserResource
    {
        return new UserResource(auth()->user());
    }

    public function postUpdateUser(UpdateUserRequest $request, UserService $userService) : ResponseResource
    {
        return new ResponseResource($userService->update($request->all()));
    }
}
