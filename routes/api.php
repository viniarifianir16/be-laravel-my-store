<?php

use App\Http\Controllers\BarangController;
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
});
