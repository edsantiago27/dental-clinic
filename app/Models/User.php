<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 
        'username',
        'email',
        'password',
        'role',
        'patient_id',
        'dental_professional_id',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

   protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }

    const ROLE_ADMIN = 'Admin';
    const ROLE_PROFESSIONAL = 'Professional';
    const ROLE_RECEPTIONIST = 'Receptionist';
    const ROLE_PATIENT = 'Patient';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function dentalProfessional()
    {
        return $this->belongsTo(DentalProfessional::class);
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isPatient()
    {
        return $this->role === self::ROLE_PATIENT;
    }
}