<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    protected $fillable = [
        'user_id_one',
        'user_id_two',
    ];

    // علاقة المستخدم الأول
    public function userOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_one');
    }

    // علاقة المستخدم الثاني
    public function userTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_two');
    }

    // جميع الرسائل ضمن هذا الشات
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
