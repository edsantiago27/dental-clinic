<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Treatment;
use Carbon\Carbon;

class AppointmentService
{
    public function createAppointment(array $data)
    {
        $treatment = Treatment::findOrFail($data['treatment_id']);
        $startTime = Carbon::createFromFormat('H:i', $data['start_time']);
        $endTime = $startTime->copy()->addMinutes($treatment->duration_minutes);

        
       $this->checkAvailability(
        $data['dental_professional_id'],
        $data['appointment_date'],
        $data['start_time'],
        $endTime->format('H:i')
    );
// NUEVO: Validar disponibilidad del paciente
    $this->checkPatientAvailability(
        $data['patient_id'],
        $data['appointment_date'],
        $data['start_time'],
        $endTime->format('H:i')
    );

        $appointment = Appointment::create([
            'patient_id' => $data['patient_id'],
            'dental_professional_id' => $data['dental_professional_id'],
            'treatment_id' => $data['treatment_id'],
            'appointment_date' => $data['appointment_date'],
            'start_time' => $data['start_time'],
            'end_time' => $endTime->format('H:i:s'),
            'status' => Appointment::STATUS_PENDING,
            'notes' => $data['notes'] ?? null,
        ]);

        return $appointment;
    }

    public function confirmAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->status !== Appointment::STATUS_PENDING) {
            throw new \Exception('Solo se pueden confirmar citas pendientes');
        }

        $appointment->update([
            'status' => Appointment::STATUS_CONFIRMED,
            'confirmed_at' => now(),
        ]);

        return $appointment;
    }

    public function cancelAppointment($id, $reason = null)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->status === Appointment::STATUS_COMPLETED) {
            throw new \Exception('No se pueden cancelar citas completadas');
        }

        $appointment->update([
            'status' => Appointment::STATUS_CANCELLED,
            'cancelled_at' => now(),
            'cancellation_reason' => $reason,
        ]);

        return $appointment;
    }

    public function getAvailableTimeSlots($professionalId, $date)
    {
        $workStart = Carbon::createFromTime(9, 0);
        $workEnd = Carbon::createFromTime(18, 0);
        $slotDuration = 30;

        $appointments = Appointment::where('dental_professional_id', $professionalId)
            ->whereDate('appointment_date', $date)
            ->whereIn('status', [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED])
            ->get();

        $availableSlots = [];
        $currentTime = $workStart->copy();

        while ($currentTime < $workEnd) {
            $timeString = $currentTime->format('H:i');
            
            $isAvailable = true;
            foreach ($appointments as $appointment) {
                $appointmentStart = Carbon::createFromFormat('H:i:s', $appointment->start_time);
                $appointmentEnd = Carbon::createFromFormat('H:i:s', $appointment->end_time);
                
                if ($currentTime >= $appointmentStart && $currentTime < $appointmentEnd) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $availableSlots[] = $timeString;
            }

            $currentTime->addMinutes($slotDuration);
        }

        return $availableSlots;
    }

    protected function checkAvailability($professionalId, $date, $startTime, $endTime)
    {
        $conflict = Appointment::where('dental_professional_id', $professionalId)
            ->whereDate('appointment_date', $date)
            ->whereIn('status', [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED])
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();

        if ($conflict) {
            throw new \Exception('El horario seleccionado no está disponible para este profesional');
        }
    }

    protected function checkPatientAvailability($patientId, $date, $startTime, $endTime)
{
    $conflict = Appointment::where('patient_id', $patientId)
        ->whereDate('appointment_date', $date)
        ->whereIn('status', [Appointment::STATUS_PENDING, Appointment::STATUS_CONFIRMED])
        ->where(function($query) use ($startTime, $endTime) {
            $query->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime])
                  ->orWhere(function($q) use ($startTime, $endTime) {
                      $q->where('start_time', '<=', $startTime)
                        ->where('end_time', '>=', $endTime);
                  });
        })
        ->exists();

    if ($conflict) {
        throw new \Exception('Ya tienes una cita agendada a esa hora');
    }
}
}