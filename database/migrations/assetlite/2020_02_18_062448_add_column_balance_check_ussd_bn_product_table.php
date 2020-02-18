<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBalanceCheckUssdBnProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('balance_check_ussd_bn')->after('ussd_bn')->nullable();
            $table->string('call_rate_unit_bn')->after('balance_check_ussd_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('balance_check_ussd_bn');
            $table->dropColumn('call_rate_unit_bn');
        });
    }
}
