<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dfe')->group(function () {
    Route::get('/', fn() => response()->json(['api-gateway:dfe']));
});
