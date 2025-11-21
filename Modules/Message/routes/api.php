<?php

use Illuminate\Support\Facades\Route;
use Modules\Message\app\Http\Controllers\TestController;

Route::prefix('message')->group(function () {
    Route::apiResource('test', TestController::class);
    //. Routes with jwt
    Route::middleware('auth:api')->group(function () {
        //Route::get('test-jwt', fn() => response()->json(['api-controller:sys/test-jwt']));
    });
});
