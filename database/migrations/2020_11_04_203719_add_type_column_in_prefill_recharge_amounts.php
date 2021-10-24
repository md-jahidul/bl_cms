<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumnInPrefillRechargeAmounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('prefill_recharge_amounts', 'type')) {
            Schema::table('prefill_recharge_amounts', function (Blueprint $table) {
                $table->string('type')->after('sort')->default('recharge');
                $table->dropUnique('prefill_recharge_amounts_amount_unique');
                $table->unique(['amount', 'type']);
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
        if (Schema::hasColumn('prefill_recharge_amounts', 'type')) {
            Schema::table('prefill_recharge_amounts', function (Blueprint $table) {
                $table->dropUnique('prefill_recharge_amounts_amount_type_unique');
                $table->dropColumn('type');
            });
        }
    }
}
