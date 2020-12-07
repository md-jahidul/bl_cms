<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBLProductTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_b_l_product_tabs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code');
            $table->string('offer_section_slug')->nullable();
            $table->string('offer_section_title')->nullable();

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
        Schema::dropIfExists('my_b_l_product_tabs');
    }
}
