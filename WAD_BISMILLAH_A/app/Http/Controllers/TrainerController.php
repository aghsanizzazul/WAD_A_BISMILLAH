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
        $trainers = Trainer::withCount(['classSchedules' => function($query) {
            $query->where('schedule_date', '>=', now());
        }])->get();
        return view('trainers.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'phone' => 'required|regex:/^[0-9]{10,}$/',
            'email' => 'required|email|unique:trainers'
        ]);

        Trainer::create($request->all());
        return redirect()->route('trainers.index')->with('success', 'Trainer created successfully.');
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
    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainer $trainer)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'phone' => 'required|regex:/^[0-9]{10,}$/',
            'email' => 'required|email|unique:trainers,email,' . $trainer->id
        ]);

        $trainer->update($request->all());
        return redirect()->route('trainers.index')->with('success', 'Trainer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        // Check if trainer has active classes
        $hasActiveClasses = ClassSchedule::where('trainer_id', $trainer->id)
            ->where('schedule_date', '>=', now())
            ->exists();

        if ($hasActiveClasses) {
            return back()->withErrors(['error' => 'Cannot delete trainer with active classes.']);
        }

        $trainer->delete();
        return redirect()->route('trainers.index')->with('success', 'Trainer deleted successfully.');
    }
}
