<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json([__('core/base.welcome_to_app', ['appName' => config('app.name')])]));
Route::get('/health', fn() => response()->json(['ok']));
Route::get('/info', fn() => view('info'));
