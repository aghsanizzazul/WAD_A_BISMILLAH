<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\ClassSchedule;
use App\Models\Trainer;
use App\Models\Attendance;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => Member::count(),
            'active_members' => Member::where('status', 'active')->count(),
            'total_trainers' => Trainer::count(),
            'total_classes' => ClassSchedule::count(),
            'today_attendances' => Attendance::whereDate('check_in_time', today())->count(),
            'active_subscriptions' => Subscription::where('end_date', '>=', now())
                                                ->where('payment_status', 'paid')
                                                ->count(),
        ];

        $recent_members = Member::latest()->take(5)->get();
        $upcoming_classes = ClassSchedule::where('schedule_date', '>=', now())
                                       ->with('trainer')
                                       ->orderBy('schedule_date')
                                       ->take(5)
                                       ->get();
        
        $recent_attendances = Attendance::with(['member', 'classSchedule'])
                                      ->latest('check_in_time')
                                      ->take(5)
                                      ->get();

        return view('dashboard', compact('stats', 'recent_members', 'upcoming_classes', 'recent_attendances'));
    }
}
