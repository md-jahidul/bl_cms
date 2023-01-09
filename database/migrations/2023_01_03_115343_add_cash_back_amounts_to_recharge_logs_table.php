<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashBackAmountsToRechargeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recharge_logs', function (Blueprint $table) {
            $table->string('cash_back_amounts')->nullable()->after('recharge_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recharge_logs', function (Blueprint $table) {
            $table->dropColumn('cash_back_amounts');
        });
    }
}
