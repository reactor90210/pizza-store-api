<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestController extends Controller
{
   public function index(){
//       throw ValidationException::withMessages([
//           'email' => ['Email address does not match.'],
//       ]);
       throw new \Exception('Test error');
   }
}
