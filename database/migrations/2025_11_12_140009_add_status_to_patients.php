<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('dental_professional_id')->constrained('dental_professionals')->onDelete('cascade');
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null');
            
            // Información de la consulta
            $table->date('consultation_date');
            $table->text('reason_for_visit')->nullable();
            $table->text('symptoms')->nullable();
            
            // Diagnóstico y tratamiento
            $table->text('diagnosis')->nullable();
            $table->text('treatment_performed')->nullable();
            $table->text('prescriptions')->nullable();
            
            // Información dental específica
            $table->string('tooth_number')->nullable(); // Número de diente tratado
            $table->text('procedure_notes')->nullable();
            $table->boolean('anesthesia_used')->default(false);
            $table->string('anesthesia_type')->nullable();
            $table->text('xray_notes')->nullable();
            
            // Seguimiento
            $table->text('recommendations')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->text('observations')->nullable();
            
            // Costos
            $table->decimal('total_cost', 10, 2)->nullable();
            
            $table->timestamps();
            
            // Índices
            $table->index('patient_id');
            $table->index('consultation_date');
        });
        
        // Tabla para archivos adjuntos del historial
        Schema::create('medical_history_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_history_id')->constrained('medical_histories')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type'); // image, document, xray
            $table->string('mime_type');
            $table->integer('file_size'); // en bytes
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index('medical_history_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_history_files');
        Schema::dropIfExists('medical_histories');
    }
};