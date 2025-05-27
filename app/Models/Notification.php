<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'action',
        'action_id',
        'is_general',
        'icon'
    ];

    protected $casts = [
        'is_general' => 'boolean'
    ];
    protected $with = ['translation'];



    /**
     * Get the user notifications for this notification.
     */
    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}
