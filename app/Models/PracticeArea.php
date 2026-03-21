<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PracticeArea extends Model {
    protected $fillable = ['title', 'slug', 'description', 'content', 'icon', 'order', 'is_active'];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public function getRouteKeyName() {
        return 'slug';
    }
}
