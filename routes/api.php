<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\TreatmentController;

// Rutas públicas
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Rutas públicas de consulta
Route::get('/treatments', [TreatmentController::class, 'index']);
Route::get('/professionals', [ProfessionalController::class, 'index']);
Route::get('/appointments/available-slots', [AppointmentController::class, 'availableSlots']);

// Crear cita sin autenticación
Route::post('/appointments/public', [AppointmentController::class, 'store']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Autenticación
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Citas
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::get('/appointments/{id}', [AppointmentController::class, 'show']);
    Route::put('/appointments/{id}/confirm', [AppointmentController::class, 'confirm']);
    Route::put('/appointments/{id}/cancel', [AppointmentController::class, 'cancel']);

    // Pacientes
    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);

    // Profesionales
    Route::get('/professionals/{id}', [ProfessionalController::class, 'show']);

    // Tratamientos
    Route::get('/treatments/{id}', [TreatmentController::class, 'show']);
});