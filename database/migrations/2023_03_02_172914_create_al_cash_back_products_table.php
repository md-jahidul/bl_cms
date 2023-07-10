<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlCashBackProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_cash_back_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('al_cash_back_id');
            $table->string('product_code')->nullable();
            $table->integer('recharge_amount')->nullable();
            $table->integer('cash_back_amount')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->foreign('al_cash_back_id')
                ->references('id')
                ->on('al_cash_backs')
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
        Schema::dropIfExists('al_cash_back_products');
    }
}
