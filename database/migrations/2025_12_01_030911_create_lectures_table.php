<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lecture', function (Blueprint $table) {
            $table->id(); // PK otomatis
            $table->string('nidn')->unique(); // nomor induk dosen
            $table->string('name');
            $table->timestamps();
        });

        // insert default lecturer (inserted into users table)
        DB::table('lecture')->insert([
            'name' => 'Default 1',
            'nidn' => '123',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('lecture')->insert([
            'name' => 'Default 2',
            'nidn' => '321',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture');
    }
};