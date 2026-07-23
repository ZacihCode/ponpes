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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['sebaran', 'kiprah']);
            $table->string('nama');
            $table->year('tahun_lulus');
            $table->string('badge')->nullable();
            $table->string('profesi_atau_kampus');
            $table->text('deskripsi')->nullable();
            $table->integer('hafalan_juz')->default(0);
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
