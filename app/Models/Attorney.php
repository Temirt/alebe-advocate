<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Attorney extends Model {
    protected $fillable = ['name', 'slug', 'title', 'bio', 'photo', 'education', 'bar_admissions', 'awards', 'email', 'phone', 'order', 'is_active'];
    
    protected $casts = [
        'education' => 'array',
        'bar_admissions' => 'array',
        'awards' => 'array',
        'is_active' => 'boolean',
    ];
    
    public function getRouteKeyName() {
        return 'slug';
    }
}
