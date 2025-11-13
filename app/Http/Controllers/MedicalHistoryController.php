<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\MedicalHistoryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MedicalHistoryController extends Controller
{
    /**
     * Listar historiales médicos (con filtros)
     */
    public function index(Request $request)
    {
        $query = MedicalHistory::with(['patient', 'dentalProfessional', 'appointment', 'files']);

        // Filtrar por paciente
        if ($request->has('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        // Filtrar por profesional
        if ($request->has('dental_professional_id')) {
            $query->where('dental_professional_id', $request->dental_professional_id);
        }

        // Filtrar por rango de fechas
        if ($request->has('date_from')) {
            $query->where('consultation_date', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->where('consultation_date', '<=', $request->date_to);
        }

        $histories = $query->orderBy('consultation_date', 'desc')->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $histories
        ]);
    }

    /**
     * Obtener un historial específico
     */
    public function show($id)
    {
        $history = MedicalHistory::with(['patient', 'dentalProfessional', 'appointment', 'files'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    /**
     * Crear nuevo historial médico
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'dental_professional_id' => 'required|exists:dental_professionals,id',
            'consultation_date' => 'required|date',
            'reason_for_visit' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatment_performed' => 'nullable|string',
            'prescriptions' => 'nullable|string',
            'tooth_number' => 'nullable|string',
            'procedure_notes' => 'nullable|string',
            'anesthesia_used' => 'nullable|boolean',
            'anesthesia_type' => 'nullable|string',
            'xray_notes' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'next_visit_date' => 'nullable|date',
            'observations' => 'nullable|string',
            'total_cost' => 'nullable|numeric',
            'appointment_id' => 'nullable|exists:appointments,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $history = MedicalHistory::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Historial médico creado exitosamente',
            'data' => $history->load(['patient', 'dentalProfessional', 'files'])
        ], 201);
    }

    /**
     * Actualizar historial médico
     */
    public function update(Request $request, $id)
    {
        $history = MedicalHistory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'patient_id' => 'sometimes|exists:patients,id',
            'dental_professional_id' => 'sometimes|exists:dental_professionals,id',
            'consultation_date' => 'sometimes|date',
            'reason_for_visit' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatment_performed' => 'nullable|string',
            'prescriptions' => 'nullable|string',
            'tooth_number' => 'nullable|string',
            'procedure_notes' => 'nullable|string',
            'anesthesia_used' => 'nullable|boolean',
            'anesthesia_type' => 'nullable|string',
            'xray_notes' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'next_visit_date' => 'nullable|date',
            'observations' => 'nullable|string',
            'total_cost' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $history->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Historial médico actualizado exitosamente',
            'data' => $history->load(['patient', 'dentalProfessional', 'files'])
        ]);
    }

    /**
     * Eliminar historial médico
     */
    public function destroy($id)
    {
        $history = MedicalHistory::findOrFail($id);
        
        // Eliminar archivos físicos
        foreach ($history->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }
        
        $history->delete();

        return response()->json([
            'success' => true,
            'message' => 'Historial médico eliminado exitosamente'
        ]);
    }

    /**
     * Subir archivo al historial médico
     */
    public function uploadFile(Request $request, $id)
    {
        $history = MedicalHistory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:10240', // 10MB máximo
            'file_type' => 'required|in:image,document,xray',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('medical_histories/' . $history->id, $fileName, 'public');

        $medicalFile = MedicalHistoryFile::create([
            'medical_history_id' => $history->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'file_type' => $request->file_type,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Archivo subido exitosamente',
            'data' => $medicalFile
        ], 201);
    }

    /**
     * Eliminar archivo del historial
     */
    public function deleteFile($historyId, $fileId)
    {
        $file = MedicalHistoryFile::where('medical_history_id', $historyId)
            ->where('id', $fileId)
            ->firstOrFail();

        // Eliminar archivo físico
        Storage::disk('public')->delete($file->file_path);

        // Eliminar registro
        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'Archivo eliminado exitosamente'
        ]);
    }
}