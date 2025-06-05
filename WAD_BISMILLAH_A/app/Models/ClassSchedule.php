<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'trainer_id',
        'capacity',
        'schedule_date',
        'start_time',
        'end_time',
        'room'
    ];

    protected $dates = [
        'schedule_date'
    ];

    // Relationships
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Validation rules
    public static $rules = [
        'name' => 'required|unique:class_schedules',
        'trainer_id' => 'required|exists:trainers,id',
        'capacity' => 'required|integer|min:1',
        'schedule_date' => 'required|date|after_or_equal:today',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'room' => 'required'
    ];
}
