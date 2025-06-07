<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'kelas_id',
        'check_in_time'
    ];

    protected $dates = [
        'check_in_time'
    ];

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Validation rules
    public static $rules = [
        'member_id' => 'required|exists:members,id',
        'kelas_id' => 'required|exists:kelas,id',
        'check_in_time' => 'required|date'
    ];

    // Custom validation for check-in
    public static function validateCheckIn($memberId, $checkInTime)
    {
        // Check if member has checked in within the last hour
        return !static::where('member_id', $memberId)
            ->where('check_in_time', '>', now()->subHour())
            ->exists();
    }
}
