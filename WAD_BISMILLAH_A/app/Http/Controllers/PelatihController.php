<?php

namespace App\Http\Controllers;
use App\Models\Pelatih;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelatih = Pelatih::all();
        return view('pelatih.index', compact('pelatih'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelatih.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);
        Pelatih::create($request->all());

        return redirect()->route('pelatih.index')->with('success', 'Data pelatih berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelatih = Pelatih::findOrFail($id);
        return view('pelatih.show', compact('pelatih'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelatih = Pelatih::findOrFail($id);
        return view('pelatih.edit', compact('pelatih'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $pelatih = Pelatih::findOrFail($id);
        $pelatih->update($request->all());

        return redirect()->route('pelatih.index')->with('success', 'Data pelatih berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelatih = Pelatih::findOrFail($id);
        $pelatih->delete();

        return redirect()->route('pelatih.index')->with('success', 'Data pelatih berhasil dihapus.');
    }
}
