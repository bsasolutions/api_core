<?php

use Illuminate\Support\Facades\Route;

Route::prefix('message')->group(function () {
    Route::get('/', fn() => response()->json(['api-gateway:message']));
});
