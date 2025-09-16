<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->enum('day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
            $table->date('date');
            $table->time('slot_time');
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('appointment_id')->references('id')->on('appointments')->nullOnDelete();
            $table->unique(['doctor_id', 'date', 'slot_time'], 'unique_schedule_slot');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
