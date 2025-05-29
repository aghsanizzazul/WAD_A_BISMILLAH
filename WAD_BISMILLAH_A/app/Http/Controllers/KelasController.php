<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    // Menampilkan semua kelas
    public function index()
    {
        $kelas = Kelas::all();
        dd($kelas);
        return view('welcome', compact('kelas'));
    }

    // Menampilkan form tambah kelas
    public function create()
    {
        return view('classes.create');
    }

    // Menyimpan kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kelas,name',
            'capacity' => 'required|integer|min:1',
            'room' => 'required|string|max:100',
        ]);

        Kelas::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    // Menampilkan detail kelas
    public function show($id)
    {
        $class = Kelas::findOrFail($id);
        return view('classes.show', compact('class'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $class = Kelas::findOrFail($id);
        return view('classes.edit', compact('class'));
    }

    // Menyimpan update kelas
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer|min:1',
            'room' => 'required|string|max:100',
        ]);

        $class = Kelas::findOrFail($id);
        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui!');
    }

    // Menghapus kelas
    public function destroy($id)
    {
        $class = Kelas::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
