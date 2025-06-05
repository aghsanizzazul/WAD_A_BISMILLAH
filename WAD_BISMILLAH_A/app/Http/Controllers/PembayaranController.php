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
    return view('admin.pembayaran.form', compact('members', 'langganan'));
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
        return response()->json(Pembayaran::with(['member', 'langganan'])->get());
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
        $filter = $request->query('filter', 'harian'); // default harian

        $query = Pembayaran::with('member');

        // Filter berdasarkan periode
        if ($filter === 'harian') {
            $query->whereDate('payment_date', Carbon::today());
        } elseif ($filter === 'mingguan') {
            $query->whereBetween('payment_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter === 'bulanan') {
            $query->whereMonth('payment_date', Carbon::now()->month)
                    ->whereYear('payment_date', Carbon::now()->year);
        } else {
            $filter = 'semua'; // fallback kalau bukan 3 di atas
        }

        $pembayaran = $query->orderByDesc('payment_date')->get();
        $totalPeriode = $pembayaran->sum('amount'); // total dari hasil filter
        $totalSemua = Pembayaran::sum('amount');    // total keseluruhan untuk saldo GYM

        return view('admin.dashboard', compact('pembayaran', 'totalSemua', 'totalPeriode', 'filter'));
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

