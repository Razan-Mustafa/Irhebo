<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_id',
        'language',
        'title',
        'description'
    ];

    /**
     * Get the notification that owns the translation.
     */
    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
