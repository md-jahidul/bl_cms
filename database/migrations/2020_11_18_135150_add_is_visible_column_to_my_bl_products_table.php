<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsVisibleColumnToMyBlProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('my_bl_products', 'is_visible')) {
            Schema::table('my_bl_products', function (Blueprint $table) {
                $table->boolean('is_visible')->default(true)->after('status');
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
        if (Schema::hasColumn('my_bl_products', 'is_visible')) {
            Schema::table('my_bl_products', function (Blueprint $table) {
                $table->dropColumn('is_visible');
            });
        }
    }
}
