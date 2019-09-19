<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNearbyOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nearby_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('vendor')->nullable();
            $table->text('location')->nullable();
            $table->text('type')->nullable();
            $table->text('offer')->nullable();
            $table->text('image');
            $table->text('offer_code')->nullable();
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
        Schema::dropIfExists('nearby_offers');
    }
}
