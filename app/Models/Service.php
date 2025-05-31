<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, HasTranslations,SoftDeletes;

    protected $fillable = [
        'sub_category_id',
        'user_id',
        'status',
        'rating',
        'reviews_count',
        'is_recommended'
    ];

    protected $with = ['translation'];


    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function media()
    {
        return $this->hasMany(ServiceMedia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function serviceWishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(PlanFeature::class);
    }


    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_features')
            ->withPivot('type', 'value')
            ->withTimestamps()
            ->distinct();
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'service_tags')
            ->withTimestamps();
    }
    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class, 'portfolio_service');
    }

}
