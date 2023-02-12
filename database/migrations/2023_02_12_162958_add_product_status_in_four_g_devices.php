<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductStatusInFourGDevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('four_g_devices', function (Blueprint $table) {
            $table->string('product_status_en')->after('buy_url');
            $table->string('product_status_bn')->after('buy_url');
            $table->string('product_status_color')->after('buy_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('four_g_devices', function (Blueprint $table) {
            $table->dropColumn('product_status_en');
            $table->dropColumn('product_status_bn');
            $table->dropColumn('product_status_color');
        });
    }
}
