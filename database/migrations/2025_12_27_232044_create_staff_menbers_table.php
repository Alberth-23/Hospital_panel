<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('staff_members', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
              ->nullable()
              ->unique()
              ->constrained('users')
              ->nullOnDelete();

        $table->string('first_name', 100);
        $table->string('last_name', 100);

        $table->string('professional_title', 150)->nullable(); // "Médico especialista en..."
        $table->string('staff_type', 50)->default('doctor');   // doctor, enfermeria, administrativo...

        // Relación opcional con services (si ya tienes esa tabla luego)
        $table->unsignedBigInteger('service_id')->nullable(); // TODO: FK a services más adelante

        $table->string('license_number', 100)->nullable(); // colegiado, matrícula
        $table->string('phone', 30)->nullable();
        $table->string('email', 150)->nullable();

        $table->boolean('is_active')->default(true);

        $table->timestampsTz();

        $table->index('is_active');
        $table->index('service_id');
    });
}

public function down(): void
{
    Schema::dropIfExists('staff_members');
}
};
