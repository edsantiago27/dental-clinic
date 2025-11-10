<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('restrict');
            $table->foreignId('appointment_id')->constrained()->onDelete('restrict');
            $table->string('invoice_number', 50)->unique();
            $table->date('invoice_date');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('status', 20)->default('Pending');
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('invoice_number');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};