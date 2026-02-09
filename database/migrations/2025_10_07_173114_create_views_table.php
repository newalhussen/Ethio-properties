<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('views', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('car_id');
        $table->unsignedBigInteger('user_id')->nullable(); // if logged-in viewer
        $table->string('type')->default('normal'); // e.g., 'normal', 'phone'
        $table->string('ip_address')->nullable(); // optional, to prevent duplicate views
        $table->timestamps();

        $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('views');
}

};
