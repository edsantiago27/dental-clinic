<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;  // ← CORREGIDO AQUÍ
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    public function index()
    {
        try {
            $patients = Patient::all();
            
            return response()->json([
                'success' => true,
                'data' => $patients
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener pacientes: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'rut' => 'required|string|max:20|unique:patients,rut',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:100',
                'birthdate' => 'nullable|date',
                'address' => 'nullable|string|max:255',
                'allergies' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $patient = Patient::create($request->all());

            return response()->json([
                'success' => true,
                'data' => $patient,
                'message' => 'Paciente creado correctamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear paciente: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $patient
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Paciente no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $patient = Patient::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'first_name' => 'sometimes|string|max:100',
                'last_name' => 'sometimes|string|max:100',
                'rut' => 'sometimes|string|max:20|unique:patients,rut,' . $id,
                'phone' => 'sometimes|string|max:20',
                'email' => 'nullable|email|max:100',
                'birthdate' => 'nullable|date',
                'address' => 'nullable|string|max:255',
                'allergies' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $patient->update($request->all());

            return response()->json([
                'success' => true,
                'data' => $patient,
                'message' => 'Paciente actualizado correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar paciente: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        Log::info('Intentando eliminar paciente ID: ' . $id);
        
        try {
            $patient = Patient::findOrFail($id);
            Log::info('Paciente encontrado: ' . $patient->first_name . ' ' . $patient->last_name);
            
            // Verificar si tiene citas asociadas
            $appointmentsCount = Appointment::where('patient_id', $id)->count();
            Log::info('Citas asociadas: ' . $appointmentsCount);
            
            if ($appointmentsCount > 0) {
                Log::warning('Paciente tiene citas asociadas');
                return response()->json([
                    'success' => false,
                    'message' => "No se puede eliminar el paciente porque tiene {$appointmentsCount} cita(s) asociada(s). Por favor elimine las citas primero."
                ], 400);
            }
            
            // Guardar user_id antes de eliminar
            $userId = $patient->user_id;
            Log::info('User ID asociado: ' . ($userId ?? 'ninguno'));
            
            // Eliminar paciente primero
            $patient->delete();
            Log::info('Paciente eliminado correctamente');
            
            // Eliminar usuario asociado si existe
            if ($userId) {
                try {
                    $user = User::find($userId);
                    if ($user) {
                        $user->delete();
                        Log::info('Usuario asociado eliminado');
                    }
                } catch (\Exception $userError) {
                    Log::warning('No se pudo eliminar el usuario: ' . $userError->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Paciente eliminado correctamente'
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Paciente no encontrado: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Paciente no encontrado'
            ], 404);
            
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Error de base de datos: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: El paciente tiene datos relacionados que impiden su eliminación'
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('Error eliminando paciente: ' . $e->getMessage());
            Log::error('Stack: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar paciente: ' . $e->getMessage()
            ], 500);
        }
    }
}