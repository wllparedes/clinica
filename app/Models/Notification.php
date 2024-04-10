<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'notifiable_id',
        'notifiable_type',
        'is_read',
    ];

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    public function medicalRequest()    
    {
        return $this->belongsTo(MedicalRequest::class, 'notifiable_id');
    }
}
