<?php

namespace App\Http\Controllers;

use App\Models\Langganan;
use Illuminate\Http\Request;

class LanggananController extends Controller
{
    public function index() {
        return response()->json(Langganan::all());
    }

    public function show($id) {
        return response()->json(Langganan::findOrFail($id));
    }

    public function destroy($id) {
        Langganan::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function create() {
    return view('admin.langganan.form', ['langganan' => new Langganan()]);
}

public function store(Request $request) {
    $validated = $request->validate([
        'name' => 'required|string',
        'duration_days' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ]);

    Langganan::create($validated);
    return redirect()->route('langganan.index')->with('success', 'Paket berhasil ditambahkan.');
}

public function edit($id) {
    $langganan = Langganan::findOrFail($id);
    return view('admin.langganan.form', compact('langganan'));
}

public function update(Request $request, $id) {
    $validated = $request->validate([
        'name' => 'required|string',
        'duration_days' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ]);

    $langganan = Langganan::findOrFail($id);
    $langganan->update($validated);

    return redirect()->route('langganan.index')->with('success', 'Paket berhasil diperbarui.');
}
}
