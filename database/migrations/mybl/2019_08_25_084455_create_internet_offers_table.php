<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternetOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internet_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->bigInteger('volume');
            $table->string('validity');
            $table->bigInteger('price')->unsigned();
            $table->string('offer_code')->unique();
            $table->bigInteger('points')->unsigned();
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
        Schema::dropIfExists('internet_offers');
    }
}
