<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

            // Crear paciente SIN user_id (puede ser null según tu migración)
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
        try {
            $patient = Patient::findOrFail($id);
            $patient->delete();

            return response()->json([
                'success' => true,
                'message' => 'Paciente eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar paciente: ' . $e->getMessage()
            ], 500);
        }
    }
}