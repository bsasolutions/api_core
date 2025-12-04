<?php

use Illuminate\Support\Facades\Route;

Route::prefix('msg')->group(function () {
    Route::get('/', fn() => response()->json(['api-gateway:msg']));
});
