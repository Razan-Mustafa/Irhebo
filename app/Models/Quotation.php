<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_id',
        'title',
        'description',
        'price',
        'delivery_day',
        'revisions',
        'source_file',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function quotationComments()
    {
        return $this->hasMany(Quotation_Comments::class);
    }
}
