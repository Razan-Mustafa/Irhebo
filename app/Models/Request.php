<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    protected $fillable = [
        'title',
        'order_number',
        'user_id',
        'service_id',
        'plan_id',
        'status',
        'image',
        'start_date',
        'end_date',
        'need_action'
    ];

    /**
     * Get the user that owns the request
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the service associated with the request
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the plan associated with the request
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get the logs for the request
     */
    public function logs(): HasMany
    {
        return $this->hasMany(RequestLog::class);
    }
}
