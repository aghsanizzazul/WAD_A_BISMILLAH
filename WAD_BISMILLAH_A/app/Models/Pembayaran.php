<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'member_id',
        'langganan_id',
        'payment_method',
        'payment_date',
        'amount',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function langganan()
    {
        return $this->belongsTo(Langganan::class);
    }
}

