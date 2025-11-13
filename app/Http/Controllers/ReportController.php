<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalHistory;
use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Laravel\Sanctum\PersonalAccessToken;

class ReportController extends Controller
{
    /**
     * Validar token desde query string
     */
    private function validateToken(Request $request)
    {
        $token = $request->query('token');
        
        if (!$token) {
            abort(401, 'Token no proporcionado');
        }
        
        $accessToken = PersonalAccessToken::findToken($token);
        
        if (!$accessToken) {
            abort(401, 'Token inválido');
        }
        
        return $accessToken->tokenable;
    }
    
    /**
     * Generar PDF del historial clínico
     */
    public function medicalHistoryPdf(Request $request, $id)
    {
        // Validar token
        $this->validateToken($request);
        
        $history = MedicalHistory::with(['patient', 'dentalProfessional', 'files'])
            ->findOrFail($id);
        
        $pdf = Pdf::loadView('reports.medical-history', compact('history'));
        
        return $pdf->download('historial_clinico_' . $history->patient->first_name . '_' . $history->patient->last_name . '.pdf');
    }
    
    /**
     * Generar PDF de historial completo del paciente
     */
    public function patientHistoryPdf(Request $request, $patientId)
    {
        // Validar token
        $this->validateToken($request);
        
        $patient = Patient::with(['medicalHistories.dentalProfessional', 'appointments.treatment'])
            ->findOrFail($patientId);
        
        $histories = $patient->medicalHistories()->orderBy('consultation_date', 'desc')->get();
        
        $pdf = Pdf::loadView('reports.patient-history', compact('patient', 'histories'));
        
        return $pdf->download('historial_completo_' . $patient->first_name . '_' . $patient->last_name . '.pdf');
    }
    
    /**
     * Generar PDF de citas
     */
    public function appointmentsPdf(Request $request)
    {
        // Validar token
        $this->validateToken($request);
        
        $query = Appointment::with(['patient', 'dentalProfessional', 'treatment']);
        
        // Filtros
        if ($request->has('date_from')) {
            $query->where('appointment_date', '>=', $request->date_from);
        }
        
        if ($request->has('date_to')) {
            $query->where('appointment_date', '<=', $request->date_to);
        }
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $appointments = $query->orderBy('appointment_date', 'desc')->get();
        
        $pdf = Pdf::loadView('reports.appointments', compact('appointments'));
        
        return $pdf->download('reporte_citas_' . date('Y-m-d') . '.pdf');
    }
}