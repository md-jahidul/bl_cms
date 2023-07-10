<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpecialTypeColumnToMyBlProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->string('special_type')->after('description')->nullable();
            $table->string('tag_bgd_color')->after('tag')->nullable();
            $table->string('tag_text_color')->after('tag_bgd_color')->nullable();
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
            $table->dropColumn('special_type');
            $table->dropColumn('tag_bgd_color');
            $table->dropColumn('tag_text_color');
        });
    }
}
