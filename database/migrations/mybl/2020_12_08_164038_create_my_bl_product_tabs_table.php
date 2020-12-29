<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlProductTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_product_tabs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code');
            $table->integer('my_bl_internet_offers_category_id');

            $table->timestamps();

            $table->index('product_code');
            $table->index('my_bl_internet_offers_category_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_bl_product_tabs');
    }
}
