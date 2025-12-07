<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_student_schedules_table.php
    public function up(): void
    {
        Schema::create('student_schedules', function (Blueprint $table) {
            $table->id();
            // Pastikan nama tabel referensinya benar (kamu pakai 'student' bukan 'students')
            $table->foreignId('student_id')->constrained('student')->onDelete('cascade');
            $table->string('day'); // Senin, Selasa, dll
            $table->time('start_time');
            $table->time('end_time');
            $table->string('activity_name')->nullable(); // Misal: "Kuliah PBO"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_schedules');
    }
};
