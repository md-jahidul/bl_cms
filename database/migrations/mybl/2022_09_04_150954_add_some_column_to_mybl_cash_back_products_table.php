<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnToMyblCashBackProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mybl_cash_back_products', function (Blueprint $table) {
            $table->boolean('override_other_campaign')->default(0)->after('status');
            $table->dateTime('start_date')->after('override_other_campaign')->nullable();
            $table->dateTime('end_date')->after('start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mybl_cash_back_products', function (Blueprint $table) {
            $table->dropColumn('override_other_campaign');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
}
