<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function getUser()
    {
        Log::info(json_encode(auth()->user(), true));
        return new UserResource(auth()->user());
    }
}
