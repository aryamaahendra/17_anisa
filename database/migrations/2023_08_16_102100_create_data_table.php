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
        Schema::create('data', function (Blueprint $table) {
            $table->id();

            $table->string('original_image', 255);
            $table->string('original_name', 255);

            $table->float('contrast', 20, 15)->nullable();
            $table->string('contrast_image', 255)->nullable();

            $table->float('energy', 20, 15)->nullable();
            $table->string('energy_image', 255)->nullable();

            $table->float('correlation', 20, 15)->nullable();
            $table->string('correlation_image', 255)->nullable();

            $table->float('homogeneity', 20, 15)->nullable();
            $table->string('homogeneity_image', 255)->nullable();

            $table->enum('class', ['premium', 'medium']);
            $table->enum('type', ['train', 'test'])->default('train');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
