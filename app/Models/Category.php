<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'icon',
        'max_price',
        'is_popular',
        'is_active'
    ];

    protected $casts = [
        'max_price' => 'decimal:2'
    ];
    protected $with = ['translation'];

    /**
     * Get the sub-categories for the category.
     */
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    /**
     * Get the filters for the category.
     */
    public function filters()
    {
        return $this->hasMany(Filter::class);
    }
    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable');
    }
}
