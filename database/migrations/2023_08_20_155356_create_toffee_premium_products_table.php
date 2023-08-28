<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToffeePremiumProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toffee_premium_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('toffee_subscription_type_id');
            $table->string('prepaid_product_codes')->nullable();
            $table->string('postpaid_product_codes')->nullable();
            $table->boolean('available_for_bl_users')->nullable();
            $table->foreign('toffee_subscription_type_id')
                ->references('id')
                ->on('toffee_subscription_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('toffee_premium_products');
    }
}
