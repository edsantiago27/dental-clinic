<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DentalProfessional extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'rut',
        'email',
        'phone',
        'specialty',
        'license_number',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}