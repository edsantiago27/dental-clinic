<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'appointment_id',
        'visit_date',
        'diagnosis',
        'treatment',
        'medications',
        'notes',
        'observations',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}