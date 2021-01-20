<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerProductPurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_product_purchase_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('banner_product_purchase_id');
            $table->string('msisdn', 20);
            $table->string('action_type');
            $table->integer('session_time');
            $table->string('error_desc');

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
        Schema::dropIfExists('banner_product_purchase_details');
    }
}
