<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'response_onesignal',
        'onesignal_id',
        'title',
        'body',
        'type',
        'type_id',
        'is_read',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
