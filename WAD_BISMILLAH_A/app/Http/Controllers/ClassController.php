<?php

namespace App\Http\Controllers;

use App\Models\GymClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = GymClass::all();
        return view('welcome', compact('classes'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
            'room' => 'required'
        ]);

        GymClass::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $class = GymClass::findOrFail($id);
        return view('edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
            'room' => 'required'
        ]);

        $class = GymClass::findOrFail($id);
        $class->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $class = GymClass::findOrFail($id);
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus.');
    }
} 