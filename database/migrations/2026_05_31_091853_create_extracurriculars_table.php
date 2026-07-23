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
        Schema::create('extracurriculars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('extracurricular_categories')
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon');

            // tampil di card
            $table->text('short_description');

            // tampil di modal
            $table->longText('description');

            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extracurriculars');
    }
};
