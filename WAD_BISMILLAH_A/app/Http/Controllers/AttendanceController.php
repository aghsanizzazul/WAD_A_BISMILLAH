<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with(['member', 'classSchedule'])
            ->latest('check_in_time')
            ->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::where('status', 'active')->get();
        $classes = ClassSchedule::where('schedule_date', '>=', now())->get();
        return view('attendances.create', compact('members', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'class_schedule_id' => 'required|exists:class_schedules,id',
            'check_in_time' => 'required|date'
        ]);

        // Check if member is active
        $member = Member::find($request->member_id);
        if ($member->status !== 'active') {
            return back()->withErrors(['member_id' => 'Member is not active.'])->withInput();
        }

        // Check for duplicate check-in within an hour
        $recentCheckIn = Attendance::where('member_id', $request->member_id)
            ->where('check_in_time', '>', now()->subHour())
            ->exists();

        if ($recentCheckIn) {
            return back()->withErrors(['check_in_time' => 'Member has already checked in within the last hour.'])->withInput();
        }

        // Check if class is full
        $class = ClassSchedule::find($request->class_schedule_id);
        $attendanceCount = Attendance::where('class_schedule_id', $request->class_schedule_id)->count();
        if ($attendanceCount >= $class->capacity) {
            return back()->withErrors(['class_schedule_id' => 'This class is already full.'])->withInput();
        }

        Attendance::create($request->all());
        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
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
    public function edit(Attendance $attendance)
    {
        $members = Member::where('status', 'active')->get();
        $classes = ClassSchedule::where('schedule_date', '>=', now())->get();
        return view('attendances.edit', compact('attendance', 'members', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'class_schedule_id' => 'required|exists:class_schedules,id',
            'check_in_time' => 'required|date'
        ]);

        // Check if member is active
        $member = Member::find($request->member_id);
        if ($member->status !== 'active') {
            return back()->withErrors(['member_id' => 'Member is not active.'])->withInput();
        }

        // Check if class is full (excluding current attendance)
        $class = ClassSchedule::find($request->class_schedule_id);
        $attendanceCount = Attendance::where('class_schedule_id', $request->class_schedule_id)
            ->where('id', '!=', $attendance->id)
            ->count();
        if ($attendanceCount >= $class->capacity) {
            return back()->withErrors(['class_schedule_id' => 'This class is already full.'])->withInput();
        }

        $attendance->update($request->all());
        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
}
