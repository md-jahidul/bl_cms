<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsToMyBlProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->boolean('is_banner_schedule')->default(0);
            $table->boolean('is_tags_schedule')->default(0);
            $table->boolean('is_visible_schedule')->default(0);
            $table->boolean('is_pin_to_top_schedule')->default(0);
            $table->boolean('is_base_msisdn_group_id_schedule')->default(0);
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
            $table->dropColumn('is_banner_schedule');
            $table->dropColumn('is_tags_schedule');
            $table->dropColumn('is_visible_schedule');
            $table->dropColumn('is_pin_to_top_schedule');
            $table->dropColumn('is_base_msisdn_group_id_schedule');
        });
    }
}
