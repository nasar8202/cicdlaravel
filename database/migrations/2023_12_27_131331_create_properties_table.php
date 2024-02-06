<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->enum('purpose_type', ['Rent', 'Buy', 'Sell'])->nullable();
            $table->string('user_id')->nullable();
            $table->string('source_url')->nullable();
            $table->string('location_and_purpose_id')->nullable();
            $table->string('price_and_area_id')->nullable();
            $table->string('feature_and_amenity_id')->nullable();
            $table->string('add_information_id')->nullable();
            $table->string('contact_information_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
