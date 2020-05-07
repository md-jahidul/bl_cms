<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVolumeDefaultValueToProductCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->integer('internet_volume_mb')->default(0)->change();
            $table->integer('sms_volume')->default(0)->change();
            $table->integer('minute_volume')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->integer('internet_volume_mb')->change();
            $table->integer('sms_volume')->change();
            $table->integer('minute_volume')->change();
        });
    }
}
