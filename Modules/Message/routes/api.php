<?php

use Illuminate\Support\Facades\Route;
use Modules\Message\app\Http\Controllers\TestController;
use Modules\Message\App\Http\Controllers\EvolutionController;
use Modules\Message\App\Http\Controllers\EvolutionControllerTest;

Route::prefix('message')->group(function () {
    Route::apiResource('test', TestController::class);
    Route::prefix('evolution')->group(function () {
        Route::post('action', [EvolutionController::class, 'action']);

        Route::get('send', [EvolutionControllerTest::class, 'send']);
        Route::get('status', [EvolutionControllerTest::class, 'status']);

        /*
        Route::get('connect', [EvolutionControllerTest::class, 'connect']);
        Route::put('restart', [EvolutionControllerTest::class, 'restart']);
        Route::delete('logout', [EvolutionControllerTest::class, 'logout']);
        Route::delete('delete', [EvolutionControllerTest::class, 'delete']);
        */
    });

    //. Routes with jwt
    Route::middleware('auth:api')->group(function () {
        //Route::get('test-jwt', fn() => response()->json(['api-controller:sys/test-jwt']));
    });
});
