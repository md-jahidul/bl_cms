<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStoreIdToStoreRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('store_ratings', 'store_id')) {
            Schema::table('store_ratings', function (Blueprint $table) {
                $table->renameColumn('store_id', 'app_id')->default('0');
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
        if (Schema::hasColumn('store_ratings','store_id')) {
            Schema::table('store_ratings', function (Blueprint $table) {
                $table->dropColumn('store_id');

            });
        }
    }
}
