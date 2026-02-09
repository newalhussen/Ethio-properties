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
        $table->string('title')->nullable()->after('model');
        $table->string('title_am')->nullable()->after('title');
        $table->text('description_am')->nullable()->after('description');
    });
}


    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('cars', function (Blueprint $table) {
        $table->dropColumn(['title', 'title_am', 'description_am']);
    });
}

};
