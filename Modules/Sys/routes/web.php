<?php

use Illuminate\Support\Facades\Route;

Route::prefix('sys')->group(function () {
    Route::get('/', fn() => response()->json(['api-controller:sys']));
});
