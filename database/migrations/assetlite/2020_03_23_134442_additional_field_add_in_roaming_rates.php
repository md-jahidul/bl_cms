<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionalFieldAddInRoamingRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_rates', function (Blueprint $table) {
            $table->string('country')->after('region')->nullable();
            $table->string('operator')->after('country')->nullable();
            $table->string('rate_visiting_country')->after('operator')->nullable();
            $table->string('rate_bangladesh')->after('rate_visiting_country')->nullable();
            $table->dropColumn('operator_id');
            $table->dropColumn('call_rate');
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
            $table->dropColumn('country');
            $table->dropColumn('operator');
            $table->dropColumn('rate_visiting_country');
            $table->dropColumn('rate_bangladesh');
            $table->string('operator_id')->after('region');
            $table->string('call_rate')->after('operator_id');
        });
    }
}
