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
    Schema::table('cars', function (Blueprint $table) {
        $table->decimal('price', 12, 2)->nullable();
        $table->enum('seller_type', ['private', 'dealership', 'broker'])->nullable();
    });
}

public function down()
{
    Schema::table('cars', function (Blueprint $table) {
        $table->dropColumn(['price', 'seller_type']);
    });
}

};
