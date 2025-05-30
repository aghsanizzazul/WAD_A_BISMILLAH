// routes/web.php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;

// Main routes for gym classes
Route::get('/', [ClassController::class, 'index']);
Route::resource('classes', ClassController::class);

// Dashboard route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
Route::get('/kelas', [ClassController::class, 'index']);
Route::get('/kelas/create', [ClassController::class, 'create']);
Route::post('/kelas', [ClassController::class, 'store']);
Route::get('/kelas/{id}/edit', [ClassController::class, 'edit']);
Route::put('/kelas/{id}', [ClassController::class, 'update']);
Route::delete('/kelas/{id}', [ClassController::class, 'destroy']);

Route::get('/jadwal', [ClassController::class, 'jadwal']);