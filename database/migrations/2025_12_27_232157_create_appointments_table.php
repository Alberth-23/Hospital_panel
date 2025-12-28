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
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('patient_id')
              ->constrained('patients')
              ->cascadeOnDelete();

        $table->foreignId('staff_member_id')
              ->constrained('staff_members')
              ->restrictOnDelete();

        $table->unsignedBigInteger('service_id')->nullable(); // TODO: FK a services más adelante

        $table->timestampTz('scheduled_start');
        $table->timestampTz('scheduled_end')->nullable();

        $table->string('status', 30)->default('scheduled');
        // scheduled, confirmed, completed, cancelled, no_show...

        $table->text('reason')->nullable();
        $table->text('notes')->nullable();

        $table->timestampsTz();

        $table->index('patient_id');
        $table->index('staff_member_id');
        $table->index('scheduled_start');
        $table->index('status');
    });
}

public function down(): void
{
    Schema::dropIfExists('appointments');
}
};
