<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langganan extends Model
{
    use HasFactory;

    protected $table = 'langganan';

    protected $fillable = [
        'name',
        'duration_days',
        'price',
    ];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
