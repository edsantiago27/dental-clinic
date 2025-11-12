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
        'anesthesia_type',      // NUEVO
        'anesthesia_dose',      // NUEVO
        'xray_taken',           // NUEVO
        'xray_notes',           // NUEVO
    ];

    protected $casts = [
         'visit_date' => 'date',
        'xray_taken' => 'boolean',
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