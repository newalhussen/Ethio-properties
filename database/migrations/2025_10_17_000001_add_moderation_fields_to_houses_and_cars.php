<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('houses')) {
            Schema::table('houses', function (Blueprint $table) {
                if (!Schema::hasColumn('houses', 'status')) {
                    $table->string('status')->default('pending')->index();
                }
                if (!Schema::hasColumn('houses', 'approved_at')) {
                    $table->timestamp('approved_at')->nullable()->index();
                }
                if (!Schema::hasColumn('houses', 'approved_by')) {
                    $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
                }
                if (!Schema::hasColumn('houses', 'rejection_reason')) {
                    $table->text('rejection_reason')->nullable();
                }
            });
        }

        if (Schema::hasTable('cars')) {
            Schema::table('cars', function (Blueprint $table) {
                if (!Schema::hasColumn('cars', 'status')) {
                    $table->string('status')->default('pending')->index();
                }
                if (!Schema::hasColumn('cars', 'approved_at')) {
                    $table->timestamp('approved_at')->nullable()->index();
                }
                if (!Schema::hasColumn('cars', 'approved_by')) {
                    $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
                }
                if (!Schema::hasColumn('cars', 'rejection_reason')) {
                    $table->text('rejection_reason')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('houses')) {
            Schema::table('houses', function (Blueprint $table) {
                if (Schema::hasColumn('houses', 'rejection_reason')) $table->dropColumn('rejection_reason');
                if (Schema::hasColumn('houses', 'approved_by')) $table->dropConstrainedForeignId('approved_by');
                if (Schema::hasColumn('houses', 'approved_at')) $table->dropColumn('approved_at');
                if (Schema::hasColumn('houses', 'status')) $table->dropColumn('status');
            });
        }
        if (Schema::hasTable('cars')) {
            Schema::table('cars', function (Blueprint $table) {
                if (Schema::hasColumn('cars', 'rejection_reason')) $table->dropColumn('rejection_reason');
                if (Schema::hasColumn('cars', 'approved_by')) $table->dropConstrainedForeignId('approved_by');
                if (Schema::hasColumn('cars', 'approved_at')) $table->dropColumn('approved_at');
                if (Schema::hasColumn('cars', 'status')) $table->dropColumn('status');
            });
        }
    }
};






