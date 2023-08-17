<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToffeeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toffee_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default('data');
            $table->string('title');
            $table->string('commercial_name_en');
            $table->string('commercial_name_bn');
            $table->integer('internet')->default(0);
            $table->integer('validity');
            $table->string('validity_unit');
            $table->double('price', 8, 2);
            $table->integer('points');
            $table->string('offer_breakdown_en');
            $table->string('offer_breakdown_bn');
            $table->string('display_sd_vat_tax');
            $table->string('product_code');
            $table->string('connection_type')->default('prepaid');
            $table->boolean('has_autorenew')->default(0);
            $table->boolean('is_recharge')->default(0);
            $table->string('image')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('toffee_products');
    }
}
