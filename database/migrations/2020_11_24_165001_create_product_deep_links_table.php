<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDeepLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_deep_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code')->nullable(false);
            $table->string('deep_link')->nullable(false);
            $table->integer('total_view')->nullable(false);
            $table->integer('total_buy')->nullable(false);
            $table->integer('total_cancel')->nullable(false);
            $table->integer('buy_attempt')->nullable(false);
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
        Schema::dropIfExists('product_deep_links');
    }
}
