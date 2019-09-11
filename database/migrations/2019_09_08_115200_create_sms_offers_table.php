<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('volume');
            $table->string('validity');
            $table->integer('price')->unsigned();
            $table->text('offer_code');
            $table->integer('points')->unsigned();
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
        Schema::dropIfExists('sms_offers');
    }
}
