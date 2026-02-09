<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // who posted it
            $table->string('title'); // example: "2020 Toyota Corolla for Sale"
            $table->text('description')->nullable();
            $table->enum('type', ['car', 'house']); // what kind of property
            $table->enum('transaction', ['sell', 'rent'])->default('sell'); // sell or rent
            $table->decimal('price', 12, 2)->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('main_image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
