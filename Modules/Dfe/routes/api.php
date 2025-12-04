<?php

use Illuminate\Support\Facades\Route;
use Modules\Dfe\app\Http\Controllers\TestController;
use Modules\Dfe\app\Http\Controllers\CnpjController;

Route::prefix('dfe')->group(function () {
    Route::apiResource('test', TestController::class);
    Route::get('/cnpj', [CnpjController::class, 'index']);
    Route::get('/cnpj/{cnpj}', [CnpjController::class, 'show']);
    /*Route::prefix('evolution')->group(function () {
        Route::post('action', [EvolutionController::class, 'action']);
    });*/

    //. Routes with jwt
    Route::middleware('auth:api')->group(function () {
        //Route::get('test-jwt', fn() => response()->json(['api-controller:sys/test-jwt']));
    });
});
