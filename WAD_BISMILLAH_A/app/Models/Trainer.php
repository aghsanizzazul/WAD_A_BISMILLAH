<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'phone',
        'email'
    ];

    // Relationships
    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }

    // Validation rules
    public static $rules = [
        'name' => 'required',
        'specialization' => 'required',
        'phone' => 'required|numeric|min:10',
        'email' => 'required|email|unique:trainers'
    ];

    // Check if trainer can be deleted
    public function canDelete()
    {
        return !$this->classSchedules()
            ->where('schedule_date', '>=', now())
            ->exists();
    }
}
