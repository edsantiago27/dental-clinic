<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('rut', 12)->unique();
            $table->string('email', 150)->unique();
            $table->string('phone', 20);
            $table->string('address', 200)->nullable();
            $table->date('date_of_birth');
            $table->string('gender', 10)->nullable();
            $table->string('emergency_contact', 100)->nullable();
            $table->string('emergency_phone', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('rut');
            $table->index('email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
};