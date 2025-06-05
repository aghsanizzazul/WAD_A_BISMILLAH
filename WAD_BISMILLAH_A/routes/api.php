use App\Http\Controllers\Api\PembayaranApiController;

Route::get('/pembayaran', [PembayaranApiController::class, 'index']); // semua data
Route::get('/pembayaran/{id}', [PembayaranApiController::class, 'show']); // 1 data
<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    route::get('/', [AuthController::class, 'index']);
    route::get('/register', [AuthController::class, 'register']);
    route::post('/store', [AuthController::class, 'store']);
    route::post('/login', [AuthController::class, 'login']);
    route::get('/kelas', [KelasController::class, 'index']);
    route::get('/kelas/create', [KelasController::class, 'create']);
    route::post('/kelas', [KelasController::class, 'store']);
    route::get('/kelas/{id}', [KelasController::class, 'show']);
    route::put('/kelas/{id}', [KelasController::class, 'update']);
    route::delete('/kelas/{id}', [KelasController::class, 'destroy']);
    return $request->user();
});
