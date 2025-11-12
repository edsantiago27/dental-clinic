<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => $treatments
        ]);
    }

    public function show($id)
    {
        $treatment = Treatment::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $treatment
        ]);
    }
    // Crear tratamiento
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:50',
            'requires_anesthesia' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $treatment = Treatment::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tratamiento creado exitosamente',
            'data' => $treatment
        ], 201);
    }

    // Actualizar tratamiento
    public function update(Request $request, $id)
    {
        $treatment = Treatment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:150',
            'description' => 'nullable|string',
            'duration_minutes' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
            'category' => 'nullable|string|max:50',
            'requires_anesthesia' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $treatment->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tratamiento actualizado exitosamente',
            'data' => $treatment
        ]);
    }

    // Eliminar tratamiento
    public function destroy($id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tratamiento eliminado exitosamente'
        ]);
    }
}