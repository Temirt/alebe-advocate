<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CaseResult extends Model {
    protected $fillable = ['title', 'description', 'practice_area', 'result_type', 'date', 'is_featured'];
    
    protected $casts = [
        'date' => 'date',
        'is_featured' => 'boolean',
    ];
}
