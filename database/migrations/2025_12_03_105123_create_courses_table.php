<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->string('major');
            $table->timestamps();
        });
        
        Schema::create('course_lecturer', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('lecture_id');
        });

        Schema::create('course_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->string(column: 'day');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};