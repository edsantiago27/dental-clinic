<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('restrict');
            $table->foreignId('appointment_id')->constrained()->onDelete('restrict');
            $table->date('visit_date');
            $table->text('diagnosis');
            $table->text('treatment')->nullable();
            $table->text('medications')->nullable();
            $table->text('notes')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_histories');
    }
};