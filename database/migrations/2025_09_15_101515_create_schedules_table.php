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
$table->enum('day', ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']);
$table->date('date');
$table->time('slot_time');
$table->enum('status', ['available','booked'])->default('available');
$table->unsignedBigInteger('appointment_id')->nullable();
$table->timestamps();


$table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
$table->foreign('appointment_id')->references('id')->on('appointments')->nullOnDelete();
});
}


public function down(): void
    {
        Schema::dropIfExists('schedules'); // was 'doctor_schedules', must match table name
    }
};
