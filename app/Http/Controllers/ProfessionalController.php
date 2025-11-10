<?php

namespace App\Http\Controllers;

use App\Models\DentalProfessional;
use Illuminate\Http\Request;

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
}