<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConnectionTypeColumnInMyBlAppLaunchPopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('my_bl_app_launch_popups', ['connection_type', 'recurring_type'])) {
            Schema::table('my_bl_app_launch_popups', function (Blueprint $table) {
                $table->string('connection_type', 20)->default('all')->after('title');
                $table->string('recurring_type', 20)->default('none')->after('connection_type');
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
        if (Schema::hasColumns('my_bl_app_launch_popups', ['connection_type', 'recurring_type'])) {
            Schema::table('my_bl_app_launch_popups', function (Blueprint $table) {
                $table->dropColumn('connection_type');
                $table->dropColumn('recurring_type');
            });
        }
    }
}
