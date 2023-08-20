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
        Schema::create('testing', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 128);
            $table->unsignedSmallInteger('k');
            $table->float('akurasi')->nullable();
            $table->float('time')->nullable();
            $table->boolean('isSet')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testing');
    }
};
