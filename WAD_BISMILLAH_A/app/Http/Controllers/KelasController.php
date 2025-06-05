<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    // Menampilkan semua kelas
    public function index()
    {
        $classes = Kelas::all();
        return view('welcome', compact('classes'));
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
            'name' => 'required',
            'capacity' => 'required|integer|min:1',
            'room' => 'required|string|max:100',
            'instructor' => 'required|string',
            'schedule_day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'nullable|string'
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
            'instructor' => 'required|string',
            'schedule_day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'nullable|string'
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
