<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMixedBundleOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mixed_bundle_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->bigInteger('internet')->unsigned();
            $table->bigInteger('minutes')->unsigned();
            $table->bigInteger('sms')->unsigned();
            $table->bigInteger('validity')->unsigned();
            $table->bigInteger('price')->unsigned();
            $table->bigInteger('points')->unsigned();
            $table->string('offer_code');
            $table->string('tag');
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
        Schema::dropIfExists('mixed_bundle_offers');
    }
}
