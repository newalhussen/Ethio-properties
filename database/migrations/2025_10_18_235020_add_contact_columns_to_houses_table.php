<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// NOTE: filename says "houses" but this migration actually alters `cars`.
// Left as-is (not renamed) because renaming would change the migration name
// Laravel tracks in the `migrations` table, causing this already-applied
// migration to be treated as new and re-run on any environment where it has
// already executed.
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('contact_phone')->nullable()->after('seller_type');
            $table->string('contact_email')->nullable()->after('contact_phone');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['contact_phone', 'contact_email']);
        });
    }
};
