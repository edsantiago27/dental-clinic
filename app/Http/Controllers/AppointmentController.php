<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index(Request $request)
    {
        $query = Appointment::with(['patient', 'dentalProfessional', 'treatment']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        if ($request->has('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        if ($request->has('professional_id')) {
            $query->where('dental_professional_id', $request->professional_id);
        }

        $appointments = $query->orderBy('appointment_date', 'desc')
                             ->orderBy('start_time', 'desc')
                             ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $appointments
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'dental_professional_id' => 'required|exists:dental_professionals,id',
            'treatment_id' => 'required|exists:treatments,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $appointment = $this->appointmentService->createAppointment($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Cita agendada exitosamente',
                'data' => $appointment->load(['patient', 'dentalProfessional', 'treatment'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'dentalProfessional', 'treatment'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $appointment
        ]);
    }

    public function confirm($id)
    {
        try {
            $appointment = $this->appointmentService->confirmAppointment($id);

            return response()->json([
                'success' => true,
                'message' => 'Cita confirmada exitosamente',
                'data' => $appointment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function cancel(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $appointment = $this->appointmentService->cancelAppointment($id, $request->reason);

            return response()->json([
                'success' => true,
                'message' => 'Cita cancelada exitosamente',
                'data' => $appointment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function availableSlots(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'professional_id' => 'required|exists:dental_professionals,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $slots = $this->appointmentService->getAvailableTimeSlots(
            $request->professional_id,
            $request->date
        );

        return response()->json([
            'success' => true,
            'data' => $slots
        ]);
    }
    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'patient_id' => 'sometimes|exists:patients,id',
        'dental_professional_id' => 'sometimes|exists:dental_professionals,id',
        'treatment_id' => 'sometimes|exists:treatments,id',
        'appointment_date' => 'sometimes|date',
        'start_time' => 'sometimes|date_format:H:i',
        'status' => 'sometimes|in:Pending,Confirmed,Completed,Cancelled',
        'notes' => 'nullable|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        $appointment->load(['patient', 'dentalProfessional', 'treatment']);

        return response()->json([
            'success' => true,
            'message' => 'Cita actualizada exitosamente',
            'data' => $appointment
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 400);
    }
}

public function destroy($id)
{
    try {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cita eliminada exitosamente'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 400);
    }
}
}