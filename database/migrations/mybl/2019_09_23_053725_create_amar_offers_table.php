<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmarOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amar_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->biginteger('internet');
            $table->biginteger('minutes');
            $table->biginteger('sms');
            $table->biginteger('validity');
            $table->biginteger('price');
            $table->text('offer_code');
            $table->text('tag')->nullable();
            $table->biginteger('points');
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
        Schema::dropIfExists('amar_offers');
    }
}
