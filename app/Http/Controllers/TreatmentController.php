<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

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
}