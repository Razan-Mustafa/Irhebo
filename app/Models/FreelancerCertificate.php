<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerCertificate extends Model
{
    protected $fillable = ['user_id', 'file_name', 'file_path', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
