<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaseMsisdnFieldInMyblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->tinyInteger('base_msisdn')->nullable('pin_to_top');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->dropColumn('base_msisdn');
        });
    }
}
