<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'dental_professional_id',
        'appointment_id',
        'consultation_date',
        'reason_for_visit',
        'symptoms',
        'diagnosis',
        'treatment_performed',
        'prescriptions',
        'tooth_number',
        'procedure_notes',
        'anesthesia_used',
        'anesthesia_type',
        'xray_notes',
        'recommendations',
        'next_visit_date',
        'observations',
        'total_cost',
    ];

    protected $casts = [
        'consultation_date' => 'date',
        'next_visit_date' => 'dat e',
        'anesthesia_used' => 'boolean',
        'total_cost' => 'decimal:2',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function dentalProfessional(): BelongsTo
    {
        return $this->belongsTo(DentalProfessional::class);
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(MedicalHistoryFile::class);
    }
}