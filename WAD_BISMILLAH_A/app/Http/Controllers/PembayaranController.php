<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Langganan;


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

    public function dashboard()
{
    $pembayaran = Pembayaran::with('member', 'langganan')->latest()->take(10)->get();
    return view('admin.dashboard', compact('pembayaran'));
}



}

