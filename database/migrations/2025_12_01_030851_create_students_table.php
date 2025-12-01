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
        Schema::create('student', function (Blueprint $table) {
            $table->id('studentid');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('transcript')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('profilephoto', 2048)->nullable();
            $table->timestamps();
        });

        // insert default student (inserted into users table)
        DB::table('student')->insert([
            'studentid' => 1,
            'email' => 'student@mail.com',
            'name' => 'Default Student',
            'transcript' => null,
            'phonenumber' => null,
            'profilephoto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('student')->insert([
            'studentid' => 2,
            'email' => 'student2@mail.com',
            'name' => 'Default Student 2',
            'transcript' => null,
            'phonenumber' => null,
            'profilephoto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
