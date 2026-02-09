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
        Schema::table('cars', function (Blueprint $table) {
            // Add user_id column if it doesn't exist
            if (!Schema::hasColumn('cars', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            
            // Migrate data from seller_id to user_id if seller_id exists
            if (Schema::hasColumn('cars', 'seller_id')) {
                // Copy seller_id to user_id for existing records
                DB::statement('UPDATE cars SET user_id = (SELECT user_id FROM sellers WHERE sellers.id = cars.seller_id) WHERE seller_id IS NOT NULL');
                
                // Drop the foreign key constraint first
                $table->dropForeign(['seller_id']);
                // Then drop the column
                $table->dropColumn('seller_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Add seller_id column back
            $table->unsignedBigInteger('seller_id')->nullable()->after('id');
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
            
            // Migrate data back from user_id to seller_id
            DB::statement('UPDATE cars SET seller_id = (SELECT id FROM sellers WHERE sellers.user_id = cars.user_id) WHERE user_id IS NOT NULL');
            
            // Drop user_id column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};