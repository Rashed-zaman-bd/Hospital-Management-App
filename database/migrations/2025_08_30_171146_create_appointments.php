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
        $table->string('appointment_id')->unique(); // Unique custom ID
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->date('date');
        $table->string('department');
        $table->string('doctor');
        $table->text('message')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
