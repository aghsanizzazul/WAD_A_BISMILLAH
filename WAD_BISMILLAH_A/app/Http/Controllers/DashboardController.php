<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get filter period (default to daily)
        $filter = $request->query('filter', 'harian');
        
        // Calculate date range based on filter
        $startDate = now();
        switch ($filter) {
            case 'mingguan':
                $startDate = $startDate->subWeek();
                break;
            case 'bulanan':
                $startDate = $startDate->subMonth();
                break;
            case 'semua':
                $startDate = null;
                break;
            default: // harian
                $startDate = $startDate->startOfDay();
        }

        // Get total payments
        $totalQuery = Pembayaran::query();
        $periodQuery = Pembayaran::query();

        if ($startDate) {
            $periodQuery->where('payment_date', '>=', $startDate);
        }

        $totalSemua = $totalQuery->sum('amount');
        $totalPeriode = $periodQuery->sum('amount');

        // Get member statistics
        $statistics = [
            'total_members' => Member::count() ?? 0,
            'active_members' => Member::active()->count() ?? 0,
            'new_members' => $startDate ? Member::where('join_date', '>=', $startDate)->count() : Member::count() ?? 0,
            'total_active_subscriptions' => Subscription::where('end_date', '>=', now())
                                                      ->where('payment_status', 'paid')
                                                      ->count() ?? 0,
            'payment_methods' => Pembayaran::select('payment_method', DB::raw('count(*) as count'))
                                         ->groupBy('payment_method')
                                         ->get() ?? collect([])
        ];

        // Get recent members with their subscription status
        $recentMembers = Member::with(['payments' => function($query) {
                                    $query->latest()->limit(1);
                                }])
                               ->latest()
                               ->take(5)
                               ->get()
                               ->map(function($member) {
                                    $lastPayment = $member->payments->first();
                                    return [
                                        'id' => $member->id,
                                        'name' => $member->name,
                                        'email' => $member->email,
                                        'join_date' => $member->join_date,
                                        'status' => $member->status,
                                        'last_payment' => $lastPayment ? $lastPayment->payment_date : null
                                    ];
                                });

        // Get recent payments
        $pembayaran = Pembayaran::with(['member', 'langganan'])
                               ->latest('payment_date')
                               ->take(5)
                               ->get();

        return view('dashboard', compact(
            'filter',
            'totalSemua',
            'totalPeriode',
            'statistics',
            'recentMembers',
            'pembayaran'
        ));
    }
}
