<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'role',
        'type',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'ai_conversation_service');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
