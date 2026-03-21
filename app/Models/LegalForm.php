<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LegalForm extends Model {
    protected $fillable = ['title', 'slug', 'description', 'category', 'price', 'file_path', 'download_count', 'is_active'];
    
    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];
    
    public function getRouteKeyName() {
        return 'slug';
    }
}
