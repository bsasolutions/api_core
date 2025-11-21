<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json(['api-gateway:']));
Route::get('/health', fn() => response()->json(['ok']));
Route::get('/info', fn() => view('info'));
