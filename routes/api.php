<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\MedicalHistoryController;


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
    //Route::post('/auth/logout', [AuthController::class, 'logout']);
    //Route::get('/auth/me', [AuthController::class, 'me']);
 Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    // Citas
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::get('/appointments/{id}', [AppointmentController::class, 'show']);
    Route::put('/appointments/{id}/confirm', [AppointmentController::class, 'confirm']);
    Route::put('/appointments/{id}/cancel', [AppointmentController::class, 'cancel']);
    Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);

    // Pacientes
    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);
    
    // Profesionales
    Route::get('/professionals/{id}', [ProfessionalController::class, 'show']);
 Route::post('/professionals', [ProfessionalController::class, 'store']);
    Route::put('/professionals/{id}', [ProfessionalController::class, 'update']);
    Route::delete('/professionals/{id}', [ProfessionalController::class, 'destroy']);

    // Tratamientos
     Route::post('/treatments', [TreatmentController::class, 'store']);
    Route::put('/treatments/{id}', [TreatmentController::class, 'update']);
    Route::delete('/treatments/{id}', [TreatmentController::class, 'destroy']);
    Route::get('/treatments/{id}', [TreatmentController::class, 'show']);

    // Historial Clínico
    Route::get('/patients/{patientId}/medical-history', [MedicalHistoryController::class, 'index']);
    Route::post('/medical-history', [MedicalHistoryController::class, 'store']);
    Route::get('/medical-history/{id}', [MedicalHistoryController::class, 'show']);
    Route::put('/medical-history/{id}', [MedicalHistoryController::class, 'update']);
    Route::post('/medical-history/{historyId}/upload-image', [MedicalHistoryController::class, 'uploadImage']);
    Route::delete('/medical-images/{imageId}', [MedicalHistoryController::class, 'deleteImage']);

});