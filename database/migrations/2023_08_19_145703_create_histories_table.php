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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();

            $table->string('uuid', 128);
            $table->string('image', 512);

            $table->float('contrast', 20, 15)->nullable();
            $table->float('energy', 20, 15)->nullable();
            $table->float('correlation', 20, 15)->nullable();
            $table->float('homogeneity', 20, 15)->nullable();

            $table->unsignedSmallInteger('k');
            $table->enum('class', ['premium', 'medium'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
