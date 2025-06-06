<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\Api\PembayaranApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;

// Public API routes
Route::middleware('api')->group(function () {
    // Pelatih API (Fikri)
    Route::apiResource('pelatih', TrainerController::class);

    // Pembayaran API (Imam & Ijul)
    Route::get('/pembayaran', [PembayaranApiController::class, 'index']);
    Route::get('/pembayaran/{id}', [PembayaranApiController::class, 'show']);
});

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    // User data
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // AuthController routes (Aceng & Imam)
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/store', [AuthController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);

    // KelasController routes (Aceng & Imam)
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::get('/kelas/create', [KelasController::class, 'create']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::get('/kelas/{id}', [KelasController::class, 'show']);
    Route::put('/kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);
});
