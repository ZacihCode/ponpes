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
        Schema::create('ostdaqu_positions', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan');
            $table->string('nama');
            $table->string('icon')->default('🕌');
            $table->enum('tipe', ['ketua', 'anggota'])->default('anggota');
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ostdaqu_positions');
    }
};
