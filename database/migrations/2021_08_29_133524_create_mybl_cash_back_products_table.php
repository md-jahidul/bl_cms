<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblCashBackProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_cash_back_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mybl_cash_back_id');
            $table->string('product_code')->nullable();
            $table->integer('recharge_amount')->nullable();
            $table->integer('cash_back_amount')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('mybl_cash_back_id')
                ->references('id')
                ->on('mybl_cash_backs')
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
        Schema::dropIfExists('mybl_cash_back_products');
    }
}
