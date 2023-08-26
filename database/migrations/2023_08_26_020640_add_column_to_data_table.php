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
        Schema::table('data', function (Blueprint $table) {
            $table->after('homogeneity_image', function () use ($table) {
                $table->float('entropy', 20, 15)->nullable();
                $table->string('entropy_image', 255)->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data', function (Blueprint $table) {
            $table->dropColumn(['entropy', 'entropy_image']);
        });
    }
};
