<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');

            $table->string('brand')->nullable();       // ስሪት
            $table->string('model')->nullable();       // ሞዴል
            $table->integer('year')->nullable();       // ዓ.ም
            $table->string('transmission')->nullable();
            $table->string('body_type')->nullable();
            $table->string('color')->nullable();       // ቀለም
            $table->string('fuel')->nullable();        // ነዳጅ
            $table->string('engine_size')->nullable();// የሲሊንደር መጠን
            $table->integer('mileage')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
