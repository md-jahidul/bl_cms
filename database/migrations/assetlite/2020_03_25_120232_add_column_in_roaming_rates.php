<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInRoamingRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_rates', function (Blueprint $table) {
            $table->string('subscription_type')->after('id')->nullable();
            $table->string('gprs')->after('data_rate')->nullable();
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roaming_rates', function (Blueprint $table) {
            $table->dropColumn('subscription_type');
            $table->dropColumn('gprs');
        });
    }
}
