<?php

use Illuminate\Support\Facades\Route;
use Modules\Sys\app\Http\Controllers\TestController;
use Modules\Sys\app\Http\Controllers\SysModuleController;
use Modules\Sys\app\Http\Controllers\SysMenuController;
use Modules\Sys\app\Http\Controllers\SysPackageController;
use Modules\Sys\app\Http\Controllers\SysMenuPackageController;
use Modules\Sys\app\Http\Controllers\SysProfileController;
use Modules\Sys\app\Http\Controllers\SysMenuProfileController;
use Modules\Sys\app\Http\Controllers\SysUserController;
use Modules\Sys\app\Http\Controllers\SysGroupController;
use Modules\Sys\app\Http\Controllers\SysServerController;
use Modules\Sys\app\Http\Controllers\SysMessageController;

Route::prefix('sys')->group(function () {
    Route::apiResource('test', TestController::class);
    //. Routes with jwt
    Route::middleware('auth:api')->group(function () {
        Route::get('test-jwt', fn() => response()->json(['api-controller:sys/test-jwt']));
        Route::apiResource('module', SysModuleController::class);
        Route::apiResource('menu', SysMenuController::class);
        Route::apiResource('package', SysPackageController::class);
        Route::apiResource('menu-package', SysMenuPackageController::class);
        Route::apiResource('profile', SysProfileController::class);
        Route::apiResource('menu-profile', SysMenuProfileController::class);

        Route::apiResource('user', SysUserController::class);
        Route::apiResource('group', SysGroupController::class);
        Route::apiResource('server', SysServerController::class);
        Route::apiResource('message', SysMessageController::class);
    });
});

//TODO Routes in api-controller-erp4 for remote access execom and create new guid
//TODO Requires img-ubuntu22 with sql server and must be developed in another project
//Route::apiResource('v2/sys/empresa', EmpresaController::class);
//Route::apiResource('v2/sys/usuario', UsuarioController::class);
//Route::get('v2/sys/usuario/access-key/{id}', [UsuarioController::class, 'accessKey']);
//Route::get('shr/decode-key/{key}', [GenerateController::class, 'decodeKey']);
//Route::get('shr/create-guid', [GenerateController::class, 'createGuid']);
