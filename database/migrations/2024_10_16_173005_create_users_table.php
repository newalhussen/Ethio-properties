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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Owner or user name
            $table->string('email')->unique(); // Must be unique
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // hashed password
            $table->string('role')->default('user'); 
            // possible roles: user, owner, admin

            $table->string('phone')->nullable(); // optional, useful for contact
            $table->string('avatar')->nullable(); // optional profile image
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
