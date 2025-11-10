<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'dental_professional_id',
        'treatment_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'notes',
        'confirmed_at',
        'cancelled_at',
        'cancellation_reason',
        'reminder_sent',
        'reminder_sent_at',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'reminder_sent' => 'boolean',
        'reminder_sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    const STATUS_PENDING = 'Pending';
    const STATUS_CONFIRMED = 'Confirmed';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_CANCELLED = 'Cancelled';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function dentalProfessional()
    {
        return $this->belongsTo(DentalProfessional::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function medicalHistory()
    {
        return $this->hasOne(MedicalHistory::class);
    }
}