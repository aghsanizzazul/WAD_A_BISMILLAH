namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class PembayaranApiController extends Controller
{
    public function index()
    {
        return response()->json(Pembayaran::with(['member', 'langganan'])->latest()->get());
    }

    public function show($id)
    {
        $data = Pembayaran::with(['member', 'langganan'])->find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data);
    }
}
