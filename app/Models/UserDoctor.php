<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDoctor extends Model
{
    protected $fillable = [
        'user_id',
        'specialization_id',
        'license_number',
        'registration_number',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }
}
