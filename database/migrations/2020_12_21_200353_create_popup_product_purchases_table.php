<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopupProductPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_product_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('popup_id');
            $table->string('product_code');
            $table->integer('total_popup_cancel')->default(0);
            $table->integer('total_popup_continue')->default(0);
            $table->integer('total_buy')->default(0);
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
        Schema::dropIfExists('popup_product_purchases');
    }
}
