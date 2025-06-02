<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\PembayaranController;

Route::prefix('admin')->group(function () {
    Route::get('/langganan', [LanggananController::class, 'index'])->name('langganan.index');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
});

// Tambah langganan
Route::get('/admin/langganan/create', [LanggananController::class, 'create'])->name('langganan.create');
Route::post('/admin/langganan', [LanggananController::class, 'store'])->name('langganan.store');

// Lihat detail pembayaran
Route::get('/admin/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');

Route::get('/admin/dashboard', [PembayaranController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/langganan/create', [LanggananController::class, 'create'])->name('langganan.create');
Route::post('/admin/langganan', [LanggananController::class, 'store'])->name('langganan.store');

Route::get('/admin/langganan/{id}/edit', [LanggananController::class, 'edit'])->name('langganan.edit');
Route::put('/admin/langganan/{id}', [LanggananController::class, 'update'])->name('langganan.update');

Route::get('/admin/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/admin/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');


Route::get('/dzulfikar-dashboard', [PembayaranController::class, 'dashboard']);
Route::get('/dzulfikar-paket', [LanggananController::class, 'index']);

Route::get('/dzulfikar-test', [PembayaranController::class, 'dashboard']);
Route::get('/dzulfikar-input', [PembayaranController::class, 'create']);

Route::get('/admin/dashboard', [PembayaranController::class, 'dashboard'])->name('admin.dashboard');

// Edit form
Route::get('/admin/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
// Update action
Route::put('/admin/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
// Delete
Route::delete('/admin/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');





