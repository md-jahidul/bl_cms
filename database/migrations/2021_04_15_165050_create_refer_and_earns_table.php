<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferAndEarnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refer_and_earns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('campaign_title');
            $table->string('dashboard_card_title');
            $table->string('dashboard_card_title_bn');
            $table->string('dashboard_card_sub_title');
            $table->string('dashboard_card_sub_title_bn');
            $table->string('dashboard_card_btn_text');
            $table->string('dashboard_card_btn_text_bn');
            $table->string('refer_card_title');
            $table->string('refer_card_title_bn');
            $table->string('refer_card_sub_title');
            $table->string('refer_card_sub_title_bn');
            $table->string('referrer_product_code');
            $table->string('referee_product_code');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('status');

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
        Schema::dropIfExists('refer_and_earns');
    }
}
