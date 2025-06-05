<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::with('member')
            ->latest()
            ->paginate(10);
        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::where('status', 'active')->get();
        return view('subscriptions.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'package_name' => 'required',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'payment_method' => 'required|in:credit_card,bank_transfer'
        ]);

        // Calculate end date based on duration
        $endDate = Carbon::parse($request->start_date)->addDays($request->duration_days);
        
        // Check for overlapping active subscriptions
        $hasActiveSubscription = Subscription::where('member_id', $request->member_id)
            ->where('end_date', '>=', $request->start_date)
            ->where('payment_status', 'paid')
            ->exists();

        if ($hasActiveSubscription) {
            return back()->withErrors(['member_id' => 'Member already has an active subscription for this period.'])->withInput();
        }

        // Create subscription with calculated end date
        $subscription = new Subscription($request->all());
        $subscription->end_date = $endDate;
        $subscription->payment_status = 'pending';
        $subscription->save();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
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
    public function edit(Subscription $subscription)
    {
        $members = Member::where('status', 'active')->get();
        return view('subscriptions.edit', compact('subscription', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'package_name' => 'required',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'payment_method' => 'required|in:credit_card,bank_transfer',
            'payment_status' => 'required|in:pending,paid,failed'
        ]);

        // Calculate end date based on duration
        $endDate = Carbon::parse($request->start_date)->addDays($request->duration_days);
        
        // Check for overlapping active subscriptions (excluding current subscription)
        $hasActiveSubscription = Subscription::where('member_id', $request->member_id)
            ->where('id', '!=', $subscription->id)
            ->where('end_date', '>=', $request->start_date)
            ->where('payment_status', 'paid')
            ->exists();

        if ($hasActiveSubscription) {
            return back()->withErrors(['member_id' => 'Member already has an active subscription for this period.'])->withInput();
        }

        // Update subscription with calculated end date
        $subscription->fill($request->all());
        $subscription->end_date = $endDate;
        $subscription->save();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        if ($subscription->payment_status === 'paid') {
            return back()->withErrors(['error' => 'Cannot delete a paid subscription.']);
        }

        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
