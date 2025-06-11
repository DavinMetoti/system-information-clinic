<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'user_id',
        'doctor_id',
        'date',
        'complaint',
        'diagnosis',
        'treatment',
        'notes',
        'prescription',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function scopeDone($query)
    {
        return $query->where('status', 'done');
    }
}
