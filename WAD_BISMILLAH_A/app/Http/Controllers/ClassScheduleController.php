<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\Trainer;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = ClassSchedule::with('trainer')->get();
        return view('class-schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = Trainer::all();
        return view('class-schedules.create', compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:class_schedules',
            'trainer_id' => 'required|exists:trainers,id',
            'capacity' => 'required|integer|min:1',
            'schedule_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room' => 'required'
        ]);

        // Check for schedule conflicts
        $conflicts = ClassSchedule::where('room', $request->room)
            ->where('schedule_date', $request->schedule_date)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($conflicts) {
            return back()->withErrors(['schedule' => 'There is a schedule conflict with another class in this room.'])->withInput();
        }

        ClassSchedule::create($request->all());
        return redirect()->route('class-schedules.index')->with('success', 'Class schedule created successfully.');
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
    public function edit(ClassSchedule $classSchedule)
    {
        $trainers = Trainer::all();
        return view('class-schedules.edit', compact('classSchedule', 'trainers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSchedule $classSchedule)
    {
        $request->validate([
            'name' => 'required|unique:class_schedules,name,' . $classSchedule->id,
            'trainer_id' => 'required|exists:trainers,id',
            'capacity' => 'required|integer|min:1',
            'schedule_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room' => 'required'
        ]);

        // Check for schedule conflicts excluding current schedule
        $conflicts = ClassSchedule::where('room', $request->room)
            ->where('schedule_date', $request->schedule_date)
            ->where('id', '!=', $classSchedule->id)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($conflicts) {
            return back()->withErrors(['schedule' => 'There is a schedule conflict with another class in this room.'])->withInput();
        }

        $classSchedule->update($request->all());
        return redirect()->route('class-schedules.index')->with('success', 'Class schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSchedule $classSchedule)
    {
        $classSchedule->delete();
        return redirect()->route('class-schedules.index')->with('success', 'Class schedule deleted successfully.');
    }
}
