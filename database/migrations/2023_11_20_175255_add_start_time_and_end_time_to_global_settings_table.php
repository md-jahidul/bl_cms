<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartTimeAndEndTimeToGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('global_settings', function (Blueprint $table) {
            $table->dateTime('start_time')->nullable()->after('redis_key');
            $table->dateTime('end_time')->nullable()->after('start_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('global_settings', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
}
