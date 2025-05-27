<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = [
        'request_id',
        'amount',
        'tax',
        'discount',
        'total',
        'payment_status',
        'payment_method',
        'paid_at',
    ];
    public function request(){
        return $this->belongsTo(Request::class);
    }
}
