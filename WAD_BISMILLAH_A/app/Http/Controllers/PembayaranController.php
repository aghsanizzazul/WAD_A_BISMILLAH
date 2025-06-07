<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Langganan;
use Illuminate\Support\Carbon;

class PembayaranController extends Controller
{
    public function create()
    {
        $members = Member::all();
        $langganan = Langganan::all();
        return view('pembayaran.form', compact('members', 'langganan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'langganan_id' => 'required|exists:langganan,id',
            'payment_method' => 'required|in:credit_card,bank_transfer',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        // Cek duplikat pembayaran di hari yang sama
        $isDuplicate = \App\Models\Pembayaran::where('member_id', $request->member_id)
            ->whereDate('payment_date', $request->payment_date)
            ->exists();

        if ($isDuplicate) {
            return back()->withErrors(['duplicate' => 'Pembayaran untuk tanggal tersebut sudah ada.'])->withInput();
        }

        \App\Models\Pembayaran::create($validated);
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function index() {
        $pembayaran = Pembayaran::with(['member', 'langganan'])->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    public function show($id) {
        return response()->json(Pembayaran::with(['member', 'langganan'])->findOrFail($id));
    }

    public function destroy($id) {
        Pembayaran::destroy($id);
        return response()->json(['message' => 'Pembayaran dihapus']);
    }

    public function dashboard(Request $request)
    {
        // Get filter from request, default to 'harian'
        $filter = $request->query('filter', 'harian');

        // Base query with member relationship
        $query = Pembayaran::with(['member', 'langganan']);

        // Filter berdasarkan periode
        switch ($filter) {
            case 'harian':
                $query->whereDate('payment_date', Carbon::today());
                break;
            case 'mingguan':
                $query->whereBetween('payment_date', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
                break;
            case 'bulanan':
                $query->whereMonth('payment_date', Carbon::now()->month)
                      ->whereYear('payment_date', Carbon::now()->year);
                break;
            default:
                $filter = 'semua';
                break;
        }

        // Get filtered payments ordered by latest first
        $pembayaran = $query->orderBy('payment_date', 'desc')->get();

        // Calculate totals
        $totalPeriode = $pembayaran->sum('amount');
        $totalSemua = Pembayaran::sum('amount');

        // Get additional statistics
        $statistics = [
            'total_members' => \App\Models\Member::count(),
            'total_active_subscriptions' => \App\Models\Langganan::count(),
            'recent_payments' => $pembayaran->take(5),
            'payment_methods' => Pembayaran::select('payment_method')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('payment_method')
                ->get()
        ];

        return view('dashboard', compact(
            'pembayaran',
            'totalSemua',
            'totalPeriode',
            'filter',
            'statistics'
        ));
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $members = Member::all();
        $langganan = Langganan::all();

        return view('admin.pembayaran.form', compact('pembayaran', 'members', 'langganan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'langganan_id' => 'required|exists:langganan,id',
            'payment_method' => 'required|in:credit_card,bank_transfer',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Pembayaran diperbarui.');
    }
}

