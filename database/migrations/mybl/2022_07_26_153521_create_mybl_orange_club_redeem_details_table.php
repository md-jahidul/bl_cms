<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblOrangeClubRedeemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_orange_club_redeem_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('redeem_title_en');
            $table->string('redeem_title_bn');
            $table->string('redeem_logo');
            $table->integer('coin_amount');
            $table->string('btn_text_en');
            $table->string('btn_text_bn');
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
        Schema::dropIfExists('mybl_orange_club_redeem_details');
    }
}
