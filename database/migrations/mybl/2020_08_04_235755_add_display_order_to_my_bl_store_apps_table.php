<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDisplayOrderToMyBlStoreAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_store_apps', function (Blueprint $table) {
            $table->integer('display_order')->nullable()->after('image_url');
            $table->tinyInteger('is_active')->default(1)->after('image_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_store_apps', function (Blueprint $table) {
            $table->dropColumn('display_order');
            $table->dropColumn('is_active');
        });
    }
}
