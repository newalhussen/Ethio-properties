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
        Schema::table('houses', function (Blueprint $table) {
            $table->index('price');
            $table->index('purpose');
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->index('brand');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->dropIndex(['price']);
            $table->dropIndex(['purpose']);
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->dropIndex(['brand']);
            $table->dropIndex(['price']);
        });
    }
};
