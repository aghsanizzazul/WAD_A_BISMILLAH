<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

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