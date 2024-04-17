<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnostic',
        'treatment',
        'medication',
        'symptoms',
        'weight',
        'height',
        'temperature',
        'medical_request_id',
    ];

    public function medicalRequest()
    {
        return $this->belongsTo(MedicalRequest::class);
    }
}
