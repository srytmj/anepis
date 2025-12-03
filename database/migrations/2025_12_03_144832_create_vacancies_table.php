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
        Schema::create('vacancy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->constrained('course')->onDelete('cascade');
            $table->integer('quota');
            $table->string('status_vac')->default('open'); // open / closed
            $table->date('close_date');
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
            $table->text('requirement')->nullable();
            $table->text('benefit')->nullable();
            $table->timestamps();
        });

        Schema::create('apply_vacancy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacancy_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('student_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            // $table->string('transcript')->nullable(); // file path
            // $table->string('cv')->nullable();        // file path
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy');
    }
};