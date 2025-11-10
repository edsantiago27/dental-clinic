<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 100)->unique()->after('id');
            $table->string('role', 20)->after('password');
            $table->foreignId('patient_id')->nullable()->after('role')->constrained()->onDelete('cascade');
            $table->foreignId('dental_professional_id')->nullable()->after('patient_id')->constrained()->onDelete('cascade');
            $table->timestamp('last_login')->nullable()->after('dental_professional_id');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'role', 'patient_id', 'dental_professional_id', 'last_login', 'deleted_at']);
        });
    }
};