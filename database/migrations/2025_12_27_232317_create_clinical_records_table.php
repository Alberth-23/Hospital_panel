<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('clinical_records', function (Blueprint $table) {
        $table->id();

        $table->foreignId('patient_id')
              ->constrained('patients')
              ->cascadeOnDelete();

        $table->foreignId('staff_member_id')
              ->nullable()
              ->constrained('staff_members')
              ->nullOnDelete();

        $table->foreignId('appointment_id')
              ->nullable()
              ->constrained('appointments')
              ->nullOnDelete();

        $table->timestampTz('record_date')->default(DB::raw('CURRENT_TIMESTAMP'));

        $table->text('summary');          // resumen del acto clínico
        $table->text('diagnosis')->nullable();
        $table->text('treatment')->nullable();
        $table->text('recommendations')->nullable();

        $table->timestampsTz();

        $table->index('patient_id');
        $table->index('staff_member_id');
        $table->index('record_date');
    });
}

public function down(): void
{
    Schema::dropIfExists('clinical_records');
}
};
