<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    use HasFactory;

    protected $table = 'classes';
    
    protected $fillable = [
        'name',
        'capacity',
        'room',
        'instructor',
        'schedule_day',
        'start_time',
        'end_time',
        'description'
    ];
} 