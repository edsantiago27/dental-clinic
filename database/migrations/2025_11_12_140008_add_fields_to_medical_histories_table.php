<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medical_histories', function (Blueprint $table) {
            $table->string('anesthesia_type', 100)->nullable()->after('observations');
            $table->string('anesthesia_dose', 100)->nullable()->after('anesthesia_type');
            $table->boolean('xray_taken')->default(false)->after('anesthesia_dose');
            $table->text('xray_notes')->nullable()->after('xray_taken');
        });
    }

    public function down()
    {
        Schema::table('medical_histories', function (Blueprint $table) {
            $table->dropColumn(['anesthesia_type', 'anesthesia_dose', 'xray_taken', 'xray_notes']);
        });
    }
};