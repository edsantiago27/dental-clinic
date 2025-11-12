<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        $user->update(['last_login' => now()]);
        $token = $user->createToken('auth_token')->plainTextToken;

        
    // Buscar el paciente si el rol es patient
    $patient = null;
    if ($user->role === 'patient') {
        $patient = Patient::where('user_id', $user->id)->first();
    }

    return response()->json([
        'success' => true,
        'data' => [
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'full_name' => $patient ? $patient->first_name . ' ' . $patient->last_name : $user->username,
                'patient_id' => $patient ? $patient->id : null
            ]
        ]
    ], 200);
}

   public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'rut' => 'required|string|max:20',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        // Buscar si ya existe un paciente con ese RUT o email
        $existingPatient = Patient::where('rut', $request->rut)
            ->orWhere('email', $request->email)
            ->whereNull('user_id') // Solo pacientes sin usuario vinculado
            ->first();

        // Crear usuario
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'username' => explode('@', $request->email)[0],
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient',
            'status' => 'active'
        ]);

        if ($existingPatient) {
            // Vincular paciente existente con el nuevo usuario
            $existingPatient->update([
                'user_id' => $user->id,
                'email' => $request->email, // Actualizar email si es diferente
                'phone' => $request->phone, // Actualizar teléfono si es diferente
            ]);
            
            $patient = $existingPatient;
            $message = 'Usuario registrado exitosamente y vinculado con su historial de paciente';
        } else {
            // Crear nuevo paciente
            $patient = Patient::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'rut' => $request->rut,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
            
            $message = 'Usuario registrado exitosamente';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'user' => $user,
                'patient' => $patient,
                'existing_patient_linked' => $existingPatient ? true : false
            ]
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al registrar usuario: ' . $e->getMessage()
        ], 500);
    }
}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sesión cerrada exitosamente'
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();
        $user->load('patient', 'dentalProfessional');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'patient_id' => $user->patient_id,  // ← Agregar esto
            'dental_professional_id' => $user->dental_professional_id,  // ← Agregar esto            
                'full_name' => $user->patient ? $user->patient->full_name : $user->username,
                'patient' => $user->patient,
                'dentalProfessional' => $user->dentalProfessional,
            ]
        ]);
    }
}