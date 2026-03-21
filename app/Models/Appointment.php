<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {
    protected $fillable = ['name', 'email', 'phone', 'preferred_date', 'preferred_time', 'practice_area', 'notes', 'status'];
    
    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime',
    ];
}
