<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Freelancer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'bio',
        'status'
    ];

    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    /**
     * Get the user that owns the freelancer profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the languages for the freelancer.
     */
    public function languages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    /**
     * Scope a query to only include freelancers with specific status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
