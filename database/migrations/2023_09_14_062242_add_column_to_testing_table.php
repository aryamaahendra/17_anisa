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
        Schema::table('testing', function (Blueprint $table) {
            $table->text('kfold_data')->nullable();
            $table->unsignedInteger('kfold')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testing', function (Blueprint $table) {
            $table->dropColumn('kfold_data');
            $table->dropColumn('kfold');
        });
    }
};
