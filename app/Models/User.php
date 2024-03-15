<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use App\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    // use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'names',
        'paternal',
        'maternal',
        'dni',
        'phone_number',
        'emergency_phone_number',
        'birth_date',
        'nationality',
        'address',
        'gender',
        'email',
        'password',
        'available',
        'status',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'full_name',
    ];


    // RELATIONSHIPS


    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'doctor_specialty', 'doctor_id', 'specialty_id')->withTimestamps();
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function avatar()
    {
        return $this->file()->where('category', 'avatars')->first();
    }

    // ACCESSORS

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->paternal} {$this->maternal}";
    }
}
