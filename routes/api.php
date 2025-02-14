<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesDetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

Route::middleware('auth:sanctum')->group(function () {
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
});

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
