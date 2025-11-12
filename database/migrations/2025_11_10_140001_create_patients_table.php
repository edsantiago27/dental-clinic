<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('rut', 20)->unique();
            $table->string('phone', 20);
            $table->string('email', 100)->nullable();
            $table->date('birthdate')->nullable();  // ← Esta línea debe existir
            $table->string('address', 255)->nullable();
            $table->text('allergies')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('patients');
    }
};