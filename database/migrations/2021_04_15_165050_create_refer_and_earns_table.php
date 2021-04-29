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
            $table->string('icon')->nullable();
            $table->string('dashboard_card_title');
            $table->string('dashboard_card_title_bn')->nullable();
            $table->text('dashboard_card_sub_title')->nullable();
            $table->text('dashboard_card_sub_title_bn')->nullable();
            $table->string('dashboard_card_btn_text')->nullable();
            $table->string('dashboard_card_btn_text_bn')->nullable();
            $table->string('refer_card_title')->nullable();
            $table->string('refer_card_title_bn')->nullable();
            $table->text('refer_card_sub_title')->nullable();
            $table->text('refer_card_sub_title_bn')->nullable();
            $table->string('redeem_card_title')->nullable();
            $table->string('redeem_card_title_bn')->nullable();
            $table->string('redeem_card_sub_title')->nullable();
            $table->string('redeem_card_sub_title_bn')->nullable();
            $table->string('referrer_product_code')->nullable();
            $table->string('referee_product_code')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('status')->default(true);
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
