<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationAndPurposesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_and_purposes', function (Blueprint $table) {
            $table->id();
            $table->enum('purpose_type', ['Rent', 'Buy','Sell'])->nullable();
            $table->string('property_type')->nullable();
            $table->string('property_sub_type')->nullable();
            $table->string('country')->nullable();
            $table->string('states')->nullable();
            $table->string('street_address')->nullable();
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
        Schema::dropIfExists('location_and_purposes');
    }
}
