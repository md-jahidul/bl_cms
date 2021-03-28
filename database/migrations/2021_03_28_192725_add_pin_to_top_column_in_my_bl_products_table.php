<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPinToTopColumnInMyBlProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('my_bl_products', 'pin_to_top')) {
            Schema::table('my_bl_products', function (Blueprint $table) {
                $table->boolean('pin_to_top')->default(false);
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
        if (Schema::hasColumn('my_bl_products', 'pin_to_top')) {
            Schema::table('my_bl_products', function (Blueprint $table) {
                $table->dropColumn('pin_to_top');
            });
        }
    }
}
