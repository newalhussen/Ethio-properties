<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            ALTER TABLE cars 
            MODIFY COLUMN price_type 
            ENUM('Per day', 'On call', 'fixed', 'negotiable', 'slightly_negotiable') 
            NOT NULL DEFAULT 'fixed'
        ");
    }

    public function down()
    {
        // revert back to old enum options
        DB::statement("
            ALTER TABLE cars 
            MODIFY COLUMN price_type 
            ENUM('fixed', 'negotiable', 'slightly_negotiable') 
            NOT NULL DEFAULT 'fixed'
        ");
    }
};
