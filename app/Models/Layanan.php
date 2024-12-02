<?php

// app/Models/Layanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'layanans';

    protected $fillable = [
        'class_name',
        'time_start',
        'time_end',
        'duration',
        'burned_calories',
        'instructor',
        'rating',
        'reviews',
        'description',
        'state',
        'image_path',
        'reminder_time',
        'available_slots',
        'class_date',
    ];

    protected $casts = [
        'rating' => 'float',
        'reviews' => 'integer',
        'reminder_time' => 'datetime',
        'available_slots' => 'integer',
    ];
}
