<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductCodeToMyBlAppLaunchPopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('my_bl_app_launch_popups','product_code')) {
            Schema::table('my_bl_app_launch_popups', function (Blueprint $table) {
                $table->string('product_code')->nullable()->after('status');
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
        if (!Schema::hasColumn('my_bl_app_launch_popups','product_code')) {
        Schema::table('my_bl_app_launch_popups', function (Blueprint $table) {
            $table->dropColumn('product_code');
        });
    }
    }
}
