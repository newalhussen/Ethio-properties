<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Use raw SQL to rename column
        DB::statement('ALTER TABLE cars CHANGE seller_id user_id BIGINT UNSIGNED');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE cars CHANGE user_id seller_id BIGINT UNSIGNED');
    }
};
