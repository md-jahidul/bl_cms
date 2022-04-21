<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlOwnRechargeInvertoryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_own_recharge_invertory_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('own_recharge_id');
            $table->integer('recharge_amount');
            $table->string('cash_back_type');
            $table->integer('cash_back_amount');
            $table->integer('number_of_apply_times')->nullable();
            $table->integer('max_amount')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('own_recharge_id')
                ->references('id')
                ->on('my_bl_own_recharge_invertories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_bl_own_recharge_invertory_products');
    }
}
