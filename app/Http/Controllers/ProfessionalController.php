<?php

namespace App\Http\Controllers;

use App\Models\DentalProfessional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionalController extends Controller
{
    public function index(Request $request)
    {
        $query = DentalProfessional::query();

        if ($request->has('available')) {
            $query->where('is_available', true);
        }

        $professionals = $query->orderBy('first_name')->get();

        return response()->json([
            'success' => true,
            'data' => $professionals
        ]);
    }

    public function show($id)
    {
        $professional = DentalProfessional::with('appointments')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $professional
        ]);
    }
    // Crear profesional
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'rut' => 'required|string|max:12|unique:dental_professionals',
            'email' => 'required|email|unique:dental_professionals',
            'phone' => 'required|string|max:20',
            'specialty' => 'required|string|max:100',
            'license_number' => 'nullable|string|max:50',
            'is_available' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $professional = DentalProfessional::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Profesional creado exitosamente',
            'data' => $professional
        ], 201);
    }

    // Actualizar profesional
    public function update(Request $request, $id)
    {
        $professional = DentalProfessional::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:100',
            'last_name' => 'sometimes|string|max:100',
            'rut' => 'sometimes|string|max:12|unique:dental_professionals,rut,' . $id,
            'email' => 'sometimes|email|unique:dental_professionals,email,' . $id,
            'phone' => 'sometimes|string|max:20',
            'specialty' => 'sometimes|string|max:100',
            'license_number' => 'nullable|string|max:50',
            'is_available' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $professional->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Profesional actualizado exitosamente',
            'data' => $professional
        ]);
    }

    // Eliminar profesional
    public function destroy($id)
    {
        $professional = DentalProfessional::findOrFail($id);
        $professional->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profesional eliminado exitosamente'
        ]);
    }
}