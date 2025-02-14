<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/test', function () {
    return "Hello from test route!";
});

Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

require __DIR__ . '/auth.php';
