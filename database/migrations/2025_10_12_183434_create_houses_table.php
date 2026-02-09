<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();

            // Owner relation (optional)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Multilingual title & description
            $table->string('title_en');
            $table->string('title_am')->nullable();

            $table->text('description_en')->nullable();
            $table->text('description_am')->nullable();

            // Basic listing attributes
            $table->enum('purpose', ['for_sale','for_rent'])->default('for_sale'); // for backend logic
            $table->string('price')->nullable(); // store as string to include currency format; can use integer later
            $table->boolean('negotiable')->default(false);
            $table->boolean('installment')->default(false);

            // location
            $table->string('region')->nullable(); // e.g. Addis Ababa
            $table->string('city_en')->nullable();
            $table->string('city_am')->nullable();
            $table->string('subcity_en')->nullable();
            $table->string('subcity_am')->nullable();
            $table->string('address')->nullable();

            // property specifics
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedInteger('area_m2')->nullable();
            $table->unsignedTinyInteger('parking')->nullable();
            $table->string('property_type')->nullable(); // Villa, Apartment, ...
            $table->unsignedSmallInteger('built_year')->nullable();
            $table->unsignedTinyInteger('floors')->nullable();
            $table->boolean('garage')->default(false);

            // Amenities and images as JSON
            $table->json('amenities')->nullable(); // store array of strings
            $table->json('images')->nullable(); // array of image paths

            // Contact & seller
            $table->string('seller_type')->nullable(); // Owner, Broker, Developer
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();

            // Extras
            $table->boolean('verified')->default(false);
            $table->string('slug')->unique()->nullable();

            // raw meta, tags etc.
            $table->json('meta')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
