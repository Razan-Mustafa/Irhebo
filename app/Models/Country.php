<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_active',
        'flag',
        'title_ar',
        'title_en'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'deleted_at' => 'datetime'
    ];
    /**
     * Get the users associated with the country.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $appends = ['title'];

    protected $hidden = ['title_en', 'title_ar'];


    public function getTitleAttribute()
    {
        $locale = App::getLocale();
        return $this->attributes["title_{$locale}"] ?? $this->title_en;
    }
}
