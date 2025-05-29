// routes/web.php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;

Route::resource('classes', KelasController::class);


Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [KelasController::class, 'index']);
Route::get('/classes', [KelasController::class, 'index'])->name('classes.index');
Route::get('/kelas', [KelasController::class, 'index']);
Route::get('/kelas/create', [KelasController::class, 'create']);
Route::post('/kelas', [KelasController::class, 'store']);
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit']);
Route::put('/kelas/{id}', [KelasController::class, 'update']);
Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/jadwal', [KelasController::class, 'jadwal']);