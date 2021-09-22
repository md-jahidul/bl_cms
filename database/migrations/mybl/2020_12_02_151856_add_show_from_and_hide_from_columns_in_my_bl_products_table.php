<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowFromAndHideFromColumnsInMyBlProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('my_bl_products', 'show_from')) {
            Schema::table('my_bl_products', function (Blueprint $table) {
                $table->dateTime('show_from')->nullable();
                $table->dateTime('hide_from')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('my_bl_products', 'show_from')) {
            Schema::table('my_bl_products', function (Blueprint $table) {
                $table->dropColumn('show_from');
                $table->dropColumn('hide_from');
            });
        }
    }
}
