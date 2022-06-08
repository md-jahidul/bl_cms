<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCashbackTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_cashback_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('campaign_id');
            $table->string('product_id');
            $table->string('msisdn');
            $table->double('consume_amount', 8, 2);
            $table->integer('total_apply_times');
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
        Schema::dropIfExists('customer_cashback_trackings');
    }
}
