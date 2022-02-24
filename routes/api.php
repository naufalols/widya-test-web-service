<?php

use App\Http\Controllers\Api_v1\AuthController;
use App\Http\Controllers\Api_v1\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\JWTController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);


// Route::middleware('auth:sanctum')->group(function () {
//     Route::resource('profile', UserController::class);
//     Route::resource('product', ProductController::class);
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::post('/refresh', [AuthController::class, 'refresh']);
//     Route::post('/profile', [AuthController::class, 'profile']);

// });


// JWT route

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::resource('/profiles', UserController::class);
    Route::resource('/product', ProductController::class);
});
