<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation_Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'quotation_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Quotation model
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

}
