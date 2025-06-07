<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $table = 'pelatih';

    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
        'spesialisasi',
        'status'
    ];

    // Relationships
    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }

    // Scope for active trainers
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for inactive trainers
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // Validation rules
    public static $rules = [
        'name' => 'required',
        'specialization' => 'required',
        'phone' => 'required|numeric|min:10',
        'email' => 'required|email|unique:pelatih'
    ];

    // Check if trainer can be deleted
    public function canDelete()
    {
        return !$this->classSchedules()
            ->where('schedule_date', '>=', now())
            ->exists();
    }
}
