<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication Routes
Auth::routes();

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/search', function () {
    return view('search');
});

Route::get('/learn-more', function () {
    return view('learn-more');
});

Route::get('/join-now', function () {
    return view('join-now');
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Member Management
    Route::resource('members', MemberController::class);
    
    // Class Schedule Management
    Route::resource('class-schedules', ClassScheduleController::class);
    
    // Trainer Management
    Route::resource('trainers', TrainerController::class);
    
    // Attendance Management
    Route::resource('attendances', AttendanceController::class);
    
    // Subscription Management
    Route::resource('subscriptions', SubscriptionController::class);
    
    // Anggota Management
    Route::resource('anggota', AnggotaController::class);
    
    // Redirect /home to /dashboard
    Route::get('/home', function() {
        return redirect('/dashboard');
    });
});
