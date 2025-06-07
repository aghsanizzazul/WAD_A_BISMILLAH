<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['member', 'kelas'])
            ->latest('check_in_time')
            ->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $members = Member::where('status', 'active')->get();
        $classes = Kelas::all();
        return view('attendances.create', compact('members', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'kelas_id' => 'required|exists:kelas,id',
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
        $class = Kelas::find($request->kelas_id);
        $attendanceCount = Attendance::where('kelas_id', $request->kelas_id)->count();
        if ($attendanceCount >= $class->capacity) {
            return back()->withErrors(['kelas_id' => 'This class is already full.'])->withInput();
        }

        Attendance::create($request->all());
        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Attendance $attendance)
    {
        $members = Member::where('status', 'active')->get();
        $classes = Kelas::all();
        return view('attendances.edit', compact('attendance', 'members', 'classes'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'kelas_id' => 'required|exists:kelas,id',
            'check_in_time' => 'required|date'
        ]);

        // Check if member is active
        $member = Member::find($request->member_id);
        if ($member->status !== 'active') {
            return back()->withErrors(['member_id' => 'Member is not active.'])->withInput();
        }

        // Check if class is full (excluding current attendance)
        $class = Kelas::find($request->kelas_id);
        $attendanceCount = Attendance::where('kelas_id', $request->kelas_id)
            ->where('id', '!=', $attendance->id)
            ->count();
        if ($attendanceCount >= $class->capacity) {
            return back()->withErrors(['kelas_id' => 'This class is already full.'])->withInput();
        }

        $attendance->update($request->all());
        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
}
