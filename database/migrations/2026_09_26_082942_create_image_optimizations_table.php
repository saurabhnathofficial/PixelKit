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
        Schema::create('image_optimizations', function (Blueprint $table) {

            $table->id();

            $table->string('original_filename');

            $table->string('original_path');

            $table->string('optimized_filename');

            $table->string('optimized_path');

            $table->unsignedBigInteger('original_size');

            $table->unsignedBigInteger('optimized_size');

            $table->decimal('saved_percentage', 5, 2);

            $table->string('original_format', 20);

            $table->string('output_format', 20);

            $table->string('operation', 30)->default('compress');

            $table->string('status', 30)->default('completed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_optimizations');
    }
};
