<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'tanggal',
        'waktu',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}