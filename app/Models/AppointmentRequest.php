<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    use HasFactory;

    public $fillable = [
        'motive',
        'comment',
        'is_urgent',
        'estimated_datetime',
        'status',
        'patient_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
