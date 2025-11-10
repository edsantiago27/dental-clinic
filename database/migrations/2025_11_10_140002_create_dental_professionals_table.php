<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dental_professionals', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('rut', 12)->unique();
            $table->string('email', 150)->unique();
            $table->string('phone', 20);
            $table->string('specialty', 100);
            $table->string('license_number', 50)->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('rut');
            $table->index('email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dental_professionals');
    }
};