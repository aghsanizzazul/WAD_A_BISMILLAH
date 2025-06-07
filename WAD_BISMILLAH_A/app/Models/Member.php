<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'join_date',
        'status'
    ];

    protected $casts = [
        'join_date' => 'date'
    ];

    // Ensure timestamps are enabled
    public $timestamps = true;

    // Relationship with payments
    public function payments()
    {
        return $this->hasMany(Pembayaran::class);
    }

    // Relationship with subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Get active subscription
    public function activeSubscription()
    {
        return $this->subscriptions()
            ->where('end_date', '>=', now())
            ->where('payment_status', 'paid')
            ->latest()
            ->first();
    }

    // Scope for active members
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for inactive members
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}   