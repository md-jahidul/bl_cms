<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddCallRateUnitToProductCoresTable
 */
class AddCallRateUnitToProductCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->string('call_rate_unit')->after('call_rate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->dropColumn('call_rate_unit');
        });
    }
}
