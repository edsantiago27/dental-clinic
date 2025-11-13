<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class TreatmentController extends Controller
{
    public function index()
    {
        try {
            $treatments = Treatment::all();
            
            return response()->json([
                'success' => true,
                'data' => $treatments
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener tratamientos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info('Creando tratamiento con datos:', $request->all());
        
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:150',
                'description' => 'required|string',
                'duration' => 'required|integer|min:1',  // Frontend envía "duration"
                'price' => 'required|numeric|min:0'
            ]);

            if ($validator->fails()) {
                Log::warning('Validación fallida:', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Mapear duration a duration_minutes
            $data = $request->all();
            $data['duration_minutes'] = $data['duration'];
            unset($data['duration']);

            $treatment = Treatment::create($data);

            return response()->json([
                'success' => true,
                'data' => $treatment,
                'message' => 'Tratamiento creado correctamente'
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creando tratamiento: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear tratamiento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $treatment = Treatment::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $treatment
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tratamiento no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Actualizando tratamiento ID ' . $id . ' con datos:', $request->all());
        
        try {
            $treatment = Treatment::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:150',
                'description' => 'sometimes|string',
                'duration' => 'sometimes|integer|min:1',
                'price' => 'sometimes|numeric|min:0'
            ]);

            if ($validator->fails()) {
                Log::warning('Validación fallida:', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Mapear duration a duration_minutes si viene
            $data = $request->all();
            if (isset($data['duration'])) {
                $data['duration_minutes'] = $data['duration'];
                unset($data['duration']);
            }

            $treatment->update($data);

            return response()->json([
                'success' => true,
                'data' => $treatment,
                'message' => 'Tratamiento actualizado correctamente'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error actualizando tratamiento: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar tratamiento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        Log::info('Eliminando tratamiento ID: ' . $id);
        
        try {
            $treatment = Treatment::findOrFail($id);
            
            // Verificar si tiene citas asociadas
            $appointmentsCount = $treatment->appointments()->count();
            
            if ($appointmentsCount > 0) {
                Log::warning('Tratamiento tiene citas asociadas');
                return response()->json([
                    'success' => false,
                    'message' => "No se puede eliminar el tratamiento porque tiene {$appointmentsCount} cita(s) asociada(s)."
                ], 400);
            }
            
            $treatment->delete();
            Log::info('Tratamiento eliminado correctamente');

            return response()->json([
                'success' => true,
                'message' => 'Tratamiento eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error eliminando tratamiento: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar tratamiento: ' . $e->getMessage()
            ], 500);
        }
    }
}