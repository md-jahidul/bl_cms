<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInMyblFlashHourProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mybl_flash_hour_products', function (Blueprint $table) {
            $table->tinyInteger('show_in_home')->after('thumbnail_img')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mybl_flash_hour_products', function (Blueprint $table) {
            $table->dropColumn('show_in_home');
        });
    }
}
