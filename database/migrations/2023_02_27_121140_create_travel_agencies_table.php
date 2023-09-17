<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_agencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('deeplink')->nullable();
            $table->string('icon')->nullable();
            $table->integer('display_order');
            $table->string('component_key');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('travel_agencies');
    }
}
