<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Authentication Routes
Auth::routes();

// Root route redirects to login if not authenticated
Route::get('/', function () {
    return redirect()->route('login');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Langganan routes
        Route::get('/langganan', [LanggananController::class, 'index'])->name('langganan.index');
        Route::get('/langganan/create', [LanggananController::class, 'create'])->name('langganan.create');
        Route::post('/langganan', [LanggananController::class, 'store'])->name('langganan.store');
        Route::get('/langganan/{id}/edit', [LanggananController::class, 'edit'])->name('langganan.edit');
        Route::put('/langganan/{id}', [LanggananController::class, 'update'])->name('langganan.update');
        Route::delete('/langganan/{id}', [LanggananController::class, 'destroy'])->name('langganan.destroy');
        
        // Pembayaran routes
        Route::get('/pembayaran/dashboard', [PembayaranController::class, 'dashboard'])->name('pembayaran.dashboard');
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
        Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
        Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
        Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

        // Member routes
        Route::resource('members', MemberController::class);

        // Trainer routes
        Route::resource('pelatih', TrainerController::class);

        // Kelas routes
        Route::get('/classes', [KelasController::class, 'index'])->name('classes.index');
        Route::get('/classes/create', [KelasController::class, 'create'])->name('classes.create');
        Route::post('/classes', [KelasController::class, 'store'])->name('classes.store');
        Route::get('/classes/{id}', [KelasController::class, 'show'])->name('classes.show');
        Route::get('/classes/{id}/edit', [KelasController::class, 'edit'])->name('classes.edit');
        Route::put('/classes/{id}', [KelasController::class, 'update'])->name('classes.update');
        Route::delete('/classes/{id}', [KelasController::class, 'destroy'])->name('classes.destroy');
    });
});





