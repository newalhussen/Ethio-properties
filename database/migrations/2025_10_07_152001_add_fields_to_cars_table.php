<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Add relationship to sellers table
            $table->foreignId('seller_id')->nullable()->constrained('sellers')->onDelete('set null');

            // Add feature and pricing columns
            $table->boolean('is_featured')->default(false);
            $table->enum('price_type', ['fixed', 'negotiable', 'slightly_negotiable'])->default('fixed');
            $table->enum('sale_rent', ['sale', 'rent'])->default('sale');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['seller_id']);
            $table->dropColumn(['seller_id', 'is_featured', 'price_type', 'sale_rent']);
        });
    }
};
