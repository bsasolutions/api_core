<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
use App\Http\Controllers\ApiIndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Redis;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\GoogleAuthController;
*/

Route::get('test', fn() => response()->json(['api-gateway:test']));

/*
//. Login
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/refresh', [AuthController::class, 'refresh']);
Route::post('auth/switch-company', [AuthController::class, 'switchCompany']);
Route::post('auth/logout', [AuthController::class, 'logout']);
//. Routes with jwt
Route::middleware('auth:api')->group(function () {
    Route::get('auth/test-jwt', fn() => response()->json(['api-controller:auth/test-jwt']));
    Route::get('auth/test-redis', [AuthController::class, 'testRedis']);
    Route::get('auth/impersonate', [AuthController::class, 'impersonate']);
    Route::get('auth/me', fn() => response()->json(auth('api')->user()));
    Route::apiResource('api', ApiIndexController::class);
    //. Register Tenants and create schema
    Route::prefix('internal')->group(function () {
        Route::get('tenant', [TenantController::class, 'index']);
        Route::post('tenant', [TenantController::class, 'store']);
    });
});

// [Not implemented] register loginClientCredentials loginGoogle
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login-client', [AuthController::class, 'loginClientCredentials']);
Route::post('auth/login-google', [AuthController::class, 'loginGoogle']);
Route::get('auth/google/redirect', [GoogleAuthController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback']);
Route::post('auth/google/token', [GoogleAuthController::class, 'fromToken']);
// [Not implemented] Necessary bearear token oauth in header
Route::middleware('auth:oauth')->group(function () {
    Route::get('auth/test-oauth', fn() => response()->json(['api-controller:auth/test-oauth']));
});
*/
