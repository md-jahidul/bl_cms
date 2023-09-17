<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToProductCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->boolean('is_commercial_name_en_schedule')->default(0);
            $table->boolean('is_commercial_name_bn_schedule')->default(0);
            $table->boolean('is_display_title_en_schedule')->default(0);
            $table->boolean('is_display_title_bn_schedule')->default(0);
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
            $table->dropColumn('is_commercial_name_en_schedule');
            $table->dropColumn('is_commercial_name_bn_schedule');
            $table->dropColumn('is_display_title_en_schedule');
            $table->dropColumn('is_display_title_bn_schedule');
        });
    }
}
