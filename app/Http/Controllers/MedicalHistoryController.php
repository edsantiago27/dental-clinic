<?php
namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\MedicalImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MedicalHistoryController extends Controller
{
    // Listar historial de un paciente
    public function index($patientId)
    {
        $histories = MedicalHistory::where('patient_id', $patientId)
            ->with(['appointment.treatment', 'appointment.dentalProfessional', 'images'])
            ->orderBy('visit_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $histories
        ]);
    }

    // Ver un historial específico
    public function show($id)
    {
        $history = MedicalHistory::with(['appointment', 'patient', 'images'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    // Crear historial clínico
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'required|exists:appointments,id',
            'visit_date' => 'required|date',
            'diagnosis' => 'required|string',
            'treatment' => 'nullable|string',
            'medications' => 'nullable|string',
            'notes' => 'nullable|string',
            'observations' => 'nullable|string',
            // Campos adicionales
            'anesthesia_type' => 'nullable|string',
            'anesthesia_dose' => 'nullable|string',
            'xray_taken' => 'boolean',
            'xray_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $history = MedicalHistory::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Historial clínico creado exitosamente',
            'data' => $history
        ], 201);
    }

    // Actualizar historial
    public function update(Request $request, $id)
    {
        $history = MedicalHistory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'visit_date' => 'sometimes|date',
            'diagnosis' => 'sometimes|string',
            'treatment' => 'nullable|string',
            'medications' => 'nullable|string',
            'notes' => 'nullable|string',
            'observations' => 'nullable|string',
            'anesthesia_type' => 'nullable|string',
            'anesthesia_dose' => 'nullable|string',
            'xray_taken' => 'boolean',
            'xray_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $history->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Historial actualizado exitosamente',
            'data' => $history
        ]);
    }

    // Subir imagen/archivo
    public function uploadImage(Request $request, $historyId)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120', // 5MB
            'image_type' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $history = MedicalHistory::findOrFail($historyId);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('medical_images', $filename, 'public');

            $image = MedicalImage::create([
                'medical_history_id' => $historyId,
                'image_type' => $request->image_type,
                'image_url' => $path,
                'description' => $request->description,
                'image_date' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Imagen subida exitosamente',
                'data' => $image
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se recibió ningún archivo'
        ], 400);
    }

    // Eliminar imagen
    public function deleteImage($imageId)
    {
        $image = MedicalImage::findOrFail($imageId);
        
        // Eliminar archivo físico
        if (Storage::disk('public')->exists($image->image_url)) {
            Storage::disk('public')->delete($image->image_url);
        }

        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Imagen eliminada exitosamente'
        ]);
    }
}
