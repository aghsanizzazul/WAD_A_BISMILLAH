<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelatih extends Model
{
    use HasFactory;

    protected $table = 'pelatih';

    protected $fillable = [
    'name',
    'specialization',
    'phone',
    'email',
    ];
}