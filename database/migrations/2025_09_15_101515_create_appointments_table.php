<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_code')->unique();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('patient_name');
            $table->string('patient_email');
            $table->string('patient_phone');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unique(['doctor_id', 'appointment_date', 'appointment_time'], 'unique_appointment_slot');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
