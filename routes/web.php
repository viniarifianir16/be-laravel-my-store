<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesDetController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/test', function () {
    return "Hello from test route!";
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return 'Cache cleared!';
});


// Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);


// BARANG
Route::get('barang', [BarangController::class, 'index']);
Route::get('barang/{id}', [BarangController::class, 'show']);
Route::post('barang', [BarangController::class, 'store']);
Route::put('barang/{id}', [BarangController::class, 'update']);
Route::delete('barang/{id}', [BarangController::class, 'destroy']);

// CUSTOMER
Route::get('customer', [CustomerController::class, 'index']);
Route::get('customer/{id}', [CustomerController::class, 'show']);
Route::post('customer', [CustomerController::class, 'store']);
Route::put('customer/{id}', [CustomerController::class, 'update']);
Route::delete('customer/{id}', [CustomerController::class, 'destroy']);

// SALES
Route::get('sales', [SalesController::class, 'index']);
Route::get('sales/last-sales-id', [SalesController::class, 'getLastAutoIncrementValue']);
Route::get('sales-report', [SalesController::class, 'salesReport']);
Route::get('sales/{id}', [SalesController::class, 'show']);
Route::post('sales', [SalesController::class, 'store']);
Route::put('sales/{id}', [SalesController::class, 'update']);
Route::delete('sales/{id}', [SalesController::class, 'destroy']);

// SALES DET
Route::get('sales-det', [SalesDetController::class, 'index']);
Route::get('sales-det/{id}', [SalesDetController::class, 'show']);
Route::post('sales-det', [SalesDetController::class, 'store']);
Route::put('sales-det/{id}', [SalesDetController::class, 'update']);
Route::delete('sales-det/{id}', [SalesDetController::class, 'destroy']);

require __DIR__ . '/auth.php';
