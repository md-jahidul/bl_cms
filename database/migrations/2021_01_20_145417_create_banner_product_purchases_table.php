<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerProductPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_product_purchases', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('slider_id');
            $table->integer('slider_image_id');
            $table->string('product_code');
            $table->integer('total_buy')->default(0);
            $table->integer('total_buy_attempt')->default(0);
            $table->integer('total_cancel')->default(0);

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
        Schema::dropIfExists('banner_product_purchases');
    }
}
