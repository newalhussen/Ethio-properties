<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Add missing columns
            $table->text('description')->nullable()->after('model');
            $table->integer('seats')->nullable()->after('engine_size');
            $table->integer('doors')->nullable()->after('seats');
            $table->string('drive_type')->nullable()->after('doors'); // e.g., AWD, FWD, RWD
            $table->string('condition')->nullable()->after('drive_type'); // e.g., New, Used, Damaged

            // Add soft deletes
            $table->softDeletes(); // Adds `deleted_at` column
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['description', 'seats', 'doors', 'drive_type', 'condition', 'deleted_at']);
        });
    }
};
