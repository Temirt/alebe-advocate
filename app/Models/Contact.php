<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'practice_area', 'is_read'];
    
    protected $casts = [
        'is_read' => 'boolean',
    ];
}
