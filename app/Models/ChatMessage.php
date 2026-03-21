<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','message','assistant_reply','faq_id','ip','user_agent'];

    protected $casts = [
        'faq_id' => 'integer',
    ];
}
