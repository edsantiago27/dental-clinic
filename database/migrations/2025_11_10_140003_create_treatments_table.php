<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->integer('duration_minutes');
            $table->decimal('price', 10, 2);
            $table->string('category', 50)->nullable();
            $table->boolean('requires_anesthesia')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('category');
        });
    }

    public function down()
    {
        Schema::dropIfExists('treatments');
    }
};