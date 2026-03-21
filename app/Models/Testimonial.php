<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = ['client_name', 'client_title', 'content', 'rating', 'photo', 'is_video', 'video_url', 'is_approved'];
    
    protected $casts = [
        'is_video' => 'boolean',
        'is_approved' => 'boolean',
    ];
}
