<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('owner_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Notifications
            $table->boolean('notify_email_inquiries')->default(true);
            $table->boolean('notify_sms_inquiries')->default(false);
            $table->boolean('notify_property_views')->default(false);
            $table->boolean('notify_property_favorites')->default(false);
            $table->boolean('notify_weekly_digest')->default(true);
            // Preferences
            $table->string('default_listing_type')->default('rent'); // rent/sale
            $table->string('list_view')->default('grid'); // grid/list
            $table->string('currency_format')->default('1,000'); // human friendly
            $table->string('measurement_unit')->default('sqm'); // sqm/sqft
            $table->boolean('dark_mode')->default(false);
            // Extra JSON for future small values
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('owner_settings');
    }
};
