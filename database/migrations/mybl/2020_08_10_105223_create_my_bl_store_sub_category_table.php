<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlStoreSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_store_sub_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id')->unsigned();
            $table->bigInteger('sub_category_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_bl_store_sub_category');
    }
}
