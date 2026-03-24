<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'form_id', 'amount', 'status', 'transaction_id',
        'guest_name', 'guest_email', 'guest_phone', 'download_count', 'downloaded_at'
    ];

    protected $casts = [
        'amount' => 'float',
        'downloaded_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
