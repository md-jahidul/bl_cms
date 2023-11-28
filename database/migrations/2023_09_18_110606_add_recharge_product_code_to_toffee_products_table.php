<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRechargeProductCodeToToffeeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toffee_products', function (Blueprint $table) {
            $table->string('recharge_product_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('toffee_products', function (Blueprint $table) {
            $table->dropColumn('recharge_product_code');
        });
    }
}
