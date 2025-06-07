<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
        'tanggal_bergabung',
        'status'
    ];

    protected $casts = [
        'tanggal_bergabung' => 'date'
    ];

    // Relationship with payments
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'member_id');
    }

    // Relationship with subscriptions
    public function langganan()
    {
        return $this->hasMany(Subscription::class, 'member_id');
    }

    // Get active subscription
    public function langgananAktif()
    {
        return $this->langganan()
            ->where('end_date', '>=', now())
            ->where('payment_status', 'paid')
            ->latest()
            ->first();
    }

    // Scope for active members
    public function scopeAktif($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for inactive members
    public function scopeNonaktif($query)
    {
        return $query->where('status', 'inactive');
    }
}
