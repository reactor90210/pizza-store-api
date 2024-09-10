<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('categories', [CategoryController::class, 'getCategories']);
Route::get('ingredients', [IngredientController::class, 'getIngredients']);
Route::get('product/{slug}', [ProductController::class, 'getBySlug']);
Route::get('products/recommended', [ProductController::class, 'getRecommended']);
Route::get('products/search', [ProductController::class, 'getSearch']);

Route::get('auth/{provider}', [AuthController::class, 'getProviderRedirect']);
Route::get('auth/{provider}/callback', [AuthController::class, 'getProviderCallback']);

Route::post('auth/login', [AuthController::class, 'postLogin']);

Route::group(['middleware'=>['jwt.verify']], function(){
    Route::get('user', [ProfileController::class, 'getUser']);
    Route::post('auth/logout', [AuthController::class, 'postLogout']);
});


