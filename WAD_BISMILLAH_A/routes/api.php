use App\Http\Controllers\Api\PembayaranApiController;

Route::get('/pembayaran', [PembayaranApiController::class, 'index']); // semua data
Route::get('/pembayaran/{id}', [PembayaranApiController::class, 'show']); // 1 data
