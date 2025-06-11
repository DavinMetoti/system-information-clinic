<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPasien extends Model
{
    protected $fillable = [
        'user_id',
        'pasien_number',
        'bpjs_number',
        'date_of_birth',
        'place_of_birth',
        'blood_type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
