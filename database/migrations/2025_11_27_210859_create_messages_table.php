<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');    // the post owner
            $table->unsignedBigInteger('customer_id'); // sender
            $table->unsignedBigInteger('post_id')->nullable(); // car/house id
            $table->string('type'); // inquiry, callback, saved_ad
            $table->text('content')->nullable();
            $table->boolean('viewed')->default(false);
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('messages');
    }
};
