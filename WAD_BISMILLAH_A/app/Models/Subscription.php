<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'package_name',
        'price',
        'duration_days',
        'start_date',
        'end_date',
        'payment_method',
        'payment_status'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Validation rules
    public static $rules = [
        'member_id' => 'required|exists:members,id',
        'package_name' => 'required',
        'price' => 'required|numeric|min:0',
        'duration_days' => 'required|integer|min:1',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'payment_method' => 'required|in:credit_card,bank_transfer',
        'payment_status' => 'required|in:pending,paid,failed'
    ];

    // Check if subscription is active
    public function isActive()
    {
        return $this->end_date >= now() && $this->payment_status === 'paid';
    }
}
