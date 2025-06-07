<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelatih = Trainer::all();
        return view('pelatih.index', compact('pelatih'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelatih.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required',
            'spesialisasi' => 'required',
            'status' => 'required'
        ]);

        Trainer::create($request->all());
        return redirect()->route('pelatih.index')->with('success', 'Trainer added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $pelatih)
    {
        return view('pelatih.form', compact('pelatih'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainer $pelatih)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required',
            'spesialisasi' => 'required',
            'status' => 'required'
        ]);

        $pelatih->update($request->all());
        return redirect()->route('pelatih.index')->with('success', 'Trainer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $pelatih)
    {
        $pelatih->delete();
        return redirect()->route('pelatih.index')->with('success', 'Trainer deleted successfully.');
    }
}
