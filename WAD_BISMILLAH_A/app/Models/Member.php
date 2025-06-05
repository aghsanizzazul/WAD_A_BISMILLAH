<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'join_date',
        'status'
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'join_date' => 'date', // Otomatis meng-cast tanggal bergabung ke objek Date
    ];

    // Relationships
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Validation rules
    public static $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:members',
        'phone' => 'required|numeric|min:10',
        'join_date' => 'required|date|before_or_equal:today'
    ];
}
